<?php

namespace App\Http\Controllers;

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
            'tipo' => $data['tipo'],
            'password' => \Hash::make($data['password']),
        ]);
    }

    private function update_user(User $user, array $data)
    {
        return $user->update(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'tipo' => $data['tipo'],
                'password' => \Hash::make($data['password']),
            ]
        );
    }

    public function store(Request $request)
    {
        try {
            if ($request->tipo==='Administrador' && \Auth::user()->email!=='jeancarlospenas@gmail.com' ){
                $data['tipo'] = 'success';
                $data['mensagem'] = 'Você não possui permissão !!!';
                $this->create($data);
                return redirect()->route('painel');
            }
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
//            $user = User::create($request->all());
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
        if (\Auth::user()->email!=='jeancarlospenas25@gmail.com'){
            $data['tipo'] = 'success';
            $data['mensagem'] = 'Você não possui permissão !!!';
            return redirect()->route('painel');
        }
        try {

            $usuarios = User::all();
            $usuario = User::findOrFail($id);
            $repositorios = RepositorioRepository::all();
            $dados = User::dados();
            return view('controle_usuario.edit', compact('dados', 'usuario', 'usuarios', 'repositorios'));
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
        try {

            if (\Auth::user()->email!=='jeancarlospenas25@gmail.com'){
                $data['tipo'] = 'success';
                $data['mensagem'] = 'Você não possui permissão !!!';
                return redirect()->route('painel');
            }
            if ($request->password !== $request->password_confirm) {
                flash('Senha não confirmada!!')->error();
                return redirect()->route('controle_usuarios.edit', ['id' => $id]);
            }
            $user = User::findOrFail($id);
            $user->tipo = $request->tipo;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->name = $request->name;
//            dd($user,$request);

//            $user_novo = $this->update_user($user, $request->all());
//            LogRepository::criar(
//                "Usuário Atualizado Com sucesso",
//                "Rota De Atualização de Usuário",
//                'controle_usuarios.edit',
//                'update');
            if ($user->update()){
                $data['tipo'] = 'success';
                $this->create_log($data);
            }

            if (\Auth::user()->tipo === 'administrador') {
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


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->tipo==='Administrador' || $user->email==='jeancarlospenas25@gmail.com'){
            $data['tipo'] = 'success';
            $data['mensagem'] = 'Você não possui permissão !!!';
            $this->create_log($data);
            return redirect()->route('painel');
        }
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


}
