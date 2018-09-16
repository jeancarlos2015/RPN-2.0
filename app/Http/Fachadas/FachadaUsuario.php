<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 17:56
 */

namespace App\Http\Fachadas;


use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\Http\Util\ValidacaoLogErros;
use App\User;
use Illuminate\Http\Request;

class FachadaUsuario extends FachadaConcreta
{
    public function index($codigo1 = null, $codigo2 = null)
    {
        try {
            $usuarios = UserRepository::listar();
            $tipo = 'usuario';
            $titulos = User::titulos();

            return view('controle_usuario.index', compact('usuarios', 'tipo', 'titulos'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function create(Request $request = null, $codigo = null)
    {
        try {
            $dados = User::dados();
            return view('controle_usuario.create', compact('dados'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'create';
            ValidacaoLogErros::create_log($data);
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
                $user = ValidacaoLogErros::create_user($request->all());
                UserRepository::limpar_cache();
                \Mail::to($user->email)->send(new EmailCadastroDeUsuario($user));
            } else {
                if ($request->tipo === 'Administrador') {
                    $data['tipo'] = 'success';
                    $data['mensagem'] = 'Usuário não foi criado !!!';
                    ValidacaoLogErros::create($data);
                    return redirect()->route('controle_usuarios.index');
                } else {
                    $user = ValidacaoLogErros::create_user($request->all());
                }
            }
            $data['tipo'] = 'success';
            ValidacaoLogErros::create($data);
            return redirect()->route('controle_usuarios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
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

            $usuarios = UserRepository::listar();
            $usuario = User::findOrFail($id);
            $repositorios = RepositorioRepository::listar();
            $dados = User::dados();
            return view('controle_usuario.edit', compact('dados', 'usuario', 'usuarios', 'repositorios'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $id = null)
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


            if (UserRepository::atualizar($request, $id)) {
                $data['tipo'] = 'success';
                ValidacaoLogErros::create_log($data);
            }
            $user = User::findOrFail($id);
            if (\Auth::user()->tipo === 'administrador') {
                return redirect()->route('controle_usuarios.index');
            } else {
                return redirect()->route('controle_usuarios.edit', ['id' => $user->cod_usuario]);
            }

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'update';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($id)
    {

        try {
            $user = User::findOrFail($id);
            if (\Auth::user()->email !== 'jeancarlospenas25@gmail.com') {
                if ($user->tipo === 'Administrador' || $user->email === 'jeancarlospenas25@gmail.com') {
                    $data['tipo'] = 'success';
                    $data['mensagem'] = 'Você não possui permissão !!!';
                    ValidacaoLogErros::create_log($data);
                    return redirect()->route('painel');
                }
            }
            UserRepository::excluir($id);
            $data['tipo'] = 'success';
            ValidacaoLogErros::create_log($data);
            return redirect()->route('controle_usuarios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }
}