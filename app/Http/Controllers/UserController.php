<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\RepositorioRepository;
use App\User;
use Illuminate\Http\Request;

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
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function create()
    {
        try {
            $dados = User::dados();
            return view('controle_usuario.create', compact('dados'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'create';
            $this->create_log($data);
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
            if (\Auth::user()->email === 'jeancarlospenas25@gmail.com') {
                $user = $this->create_user($request->all());
            } else {
                if ($request->tipo === 'Administrador') {
                    $data['tipo'] = 'success';
                    $data['mensagem'] = 'Usuário não foi criado !!!';
                    $this->create($data);
                    return redirect()->route('controle_usuarios.index');
                } else {
                    $user = $this->create_user($request->all());
                }
            }
            $data['tipo'] = 'success';
            $this->create($data);
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
        if ((\Auth::user()->email !== 'jeancarlospenas25@gmail.com') && (\Auth::user()->tipo !== 'Administrador')) {
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

            if (\Auth::user()->email !== 'jeancarlospenas25@gmail.com') {
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
            if ($user->update()) {
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
            $data['acao'] = 'update';
            $this->create_log($data);
        }
        return redirect()->route('painel');

    }

    public function edit_vinculo($codusuario)
    {
        $usuario = User::findOrFail($codusuario);
        $repositorios = RepositorioRepository::all();
        return view('controle_usuario.vinculo', compact('usuario', 'repositorios'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (\Auth::user()->email !== 'jeancarlospenas25@gmail.com') {
            if ($user->tipo === 'Administrador' || $user->email === 'jeancarlospenas25@gmail.com') {
                $data['tipo'] = 'success';
                $data['mensagem'] = 'Você não possui permissão !!!';
                $this->create_log($data);
                return redirect()->route('painel');
            }
        }

        try {
            $user->delete();
            $data['tipo'] = 'success';
            $this->create_log($data);
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
