<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\LogRepository;
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
        $usuarios = User::all();
        $tipo = 'usuario';
        $titulos = User::titulos();
        
        return view('controle_usuario.index',compact('usuarios','tipo','titulos'));
    }

 
    public function create()
    {
        $dados = User::dados();
        return view('controle_usuario.create', compact('dados'));
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
        if ($request->password!==$request->password_confirm){
            flash('Senha não confere');
            return redirect()->route('controle_usuarios.create');
        }
        $erros = \Validator::make($request->all(), User::validacao());
        if ($erros->fails()){
            return redirect()->route('controle_usuarios.create')
                ->withErrors($erros)
                ->withInput();
        }
        $user = $this->create_user($request->all());
        LogRepository::criar("Usuário Criado Com sucesso", "Rota De Criação de usuário");
        if (isset($user)) {
            flash('Usuário criado com sucesso!!');
        } else {
            flash('Usuário não foi criado!!');
        }
        return redirect()->route('controle_usuarios.index');
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $dados = User::dados();
        $dados[0]->valor = $usuario->name;
        $dados[1]->valor = $usuario->email;
        $dados[2]->valor = $usuario->password;
        return view('controle_usuario.edit', compact('dados', 'usuario'));
    }

   
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user_novo = $this->update_user($user, $request->all());
        LogRepository::criar("Usuário Atualizado Com sucesso", "Rota De Atualização de Usuário");
        if (isset($user_novo)) {
            flash('Usuário Atualizado com sucesso!!');
        } else {
            flash('Usuário não foi Atualizada!!');
        }

        return redirect()->route('controle_usuarios.index');
    }

   
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
            LogRepository::criar("Usuário Excluído Com sucesso", "Rota De Exclusão de Usuário");
        } catch (\Exception $e) {
            flash('Error de exclusão')->error();
        }
        return redirect()->route('controle_usuarios.index');
    }
}
