<?php

namespace App\Http\Controllers;

use App\Http\Models\Repositorio;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\RepositorioRepository;
use App\User;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        try {
            $usuarios = User::all();
            $tipo = 'usuario';
            $titulos = User::titulos();

            return view('controle_usuario.index', compact('usuarios', 'tipo', 'titulos'));
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_usuarios.index',
                'index');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }


    public function create()
    {
        try {
            $dados = User::dados();
            return view('controle_usuario.create', compact('dados'));
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_usuarios.create',
                'create');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }

    private function create_user(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['type'],
            'password' => \Hash::make($data['password']),
        ]);
    }

    private function update_user(User $user, array $data)
    {
        return $user->update(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => $data['type'],
                'password' => \Hash::make($data['password']),
            ]
        );
    }

    public function store(Request $request)
    {
        try {
            if ($request->password !== $request->password_confirm) {
                flash('Senha não confere');
                return redirect()->route('controle_usuarios.create');
            }
            $erros = \Validator::make($request->all(), User::validacao());
            if ($erros->fails()) {
                return redirect()->route('controle_usuarios.create')
                    ->withErrors($erros)
                    ->withInput();
            }
            $user = $this->create_user($request->all());
            LogRepository::criar(
                "Usuário Criado Com sucesso",
                "Rota De Criação de usuário",
                'controle_usuarios.create',
                'store');
            if (isset($user)) {
                flash('Usuário criado com sucesso!!');
            } else {
                flash('Usuário não foi criado!!');
            }
            return redirect()->route('controle_usuarios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        try {
            $usuario = User::findOrFail($id);
//            if (\Gate::denies('edit-user', $usuario)) {
//                abort(403);
//            }
            $dados = User::dados();
            $dados[0]->valor = $usuario->name;
            $dados[1]->valor = $usuario->email;
            $dados[2]->valor = $usuario->password;
            $usuarios = User::all();
            $repositorios = RepositorioRepository::all();
            return view('controle_usuario.edit', compact('dados', 'usuario','usuarios','repositorios'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $id)
    {
        if (!empty($request->desvincular)) {
            try {
                if($request->desvincular==='true'){
                    $user = User::findOrFail($id);
                    $user->codrepositorio = null;
                    $user->update();
                }
                $data['tipo'] = 'success';
                $this->create_log($data);
                return redirect()->route('vinculo_usuario_repositorio');
            } catch (Exception $ex) {
                $data['mensagem'] = $ex->getMessage();
                $data['tipo'] = 'error';
                $data['pagina'] = 'Painel';
                $data['acao'] = 'merge_checkout';
                $this->create_log($data);
                return redirect()->route('controle_usuarios.edit', [$id]);
            }

        } else {
            try {
                if ($request->password !== $request->password_confirm) {
                    flash('Senha não confirmada!!')->error();
                    return redirect()->route('controle_usuarios.edit', ['id' => $id]);
                }
                $user = User::findOrFail($id);
                $user_novo = $this->update_user($user, $request->all());
                LogRepository::criar(
                    "Usuário Atualizado Com sucesso",
                    "Rota De Atualização de Usuário",
                    'controle_usuarios.edit',
                    'update');
                $data['tipo'] = 'success';
                $this->create_log($data);
                if (\Auth::user()->type === 'administrador') {
                    return redirect()->route('controle_usuarios.index');
                } else {
                    return redirect()->route('controle_usuarios.edit', ['id' => $user->codusuario]);
                }

            } catch (\Exception $ex) {
                $data['mensagem'] = $ex->getMessage();
                $data['tipo'] = 'error';
                $data['pagina'] = 'Painel';
                $data['acao'] = 'merge_checkout';
                $this->create_log($data);
            }
            return redirect()->route('painel');
        }


    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
            $data['tipo'] = 'success';
            $this->create_log($data);
            LogRepository::criar(
                "Usuário Excluído Com sucesso",
                "Rota De Exclusão de Usuário",
                'controle_usuarios.index',
                'destroy');
            return redirect()->route('controle_usuarios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function vincular_usuario_repositorio(Request $request)
    {
        $codusuario = $request->codusuario;
        $codrepositorio = $request->codrepositorio;
        try {
            $usuario = User::findOrFail($codusuario);
            $repositorio = Repositorio::findOrFail($codrepositorio);
            $usuario->codrepositorio = $repositorio->codrepositorio;
            $usuario->update();
            $data['tipo'] = 'success';
            $this->create_log($data);

        } catch (Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        if (!empty($request->vinculo)){
            return redirect()->route('vinculo_usuario_repositorio');
        }
        return redirect()->route('controle_usuarios.edit',['id' => $codusuario]);
    }

    public function vinculo_usuario_repositorio()
    {
        $repositorios = RepositorioRepository::listar();
        $usuarios = User::all();
        $titulos = User::titulos();

        $tipo = 'usuario';
        return view('vinculo_usuario_repositorio.vinculo_usuario_repositorio', compact('repositorios', 'usuarios', 'titulos', 'tipo'));
    }
}
