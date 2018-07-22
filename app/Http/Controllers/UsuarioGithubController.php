<?php

namespace App\Http\Controllers;


use App\Http\Models\UsuarioGithub;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioGithubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dados = UsuarioGithub::dados();
        $branch_atual = 'Em Construção';
        return view('controle_github.configuracao', compact('dados', 'branch_atual'));
    }


    public function store(Request $request)
    {
        $erros = \Validator::make($request->all(), UsuarioGithub::validacao());
        $usuario_github = null;
        if ($erros->fails()) {
            return redirect()->route('create_github', ['codusuario' => Auth::user()->codusuario])
                ->withErrors($erros)
                ->withInput();
        }
        try {
            GitSistemaRepository::delete_all_github();
            $usuario_github = UsuarioGithub::create($request->all());
            LogRepository::criar("Dados Salvo Com sucesso", "Rota De Configuração Github");
            flash('Configuração salva com sucesso!!');
        } catch (\Exception $ex) {
            flash('O registro já existe!!!')->error();
        }
        return redirect()->route('create_github', ['codusuario' => Auth::user()->codusuario]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsuarioGithub $usuarioGithub
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioGithub $usuarioGithub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsuarioGithub $usuarioGithub
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuarioGithub $usuarioGithub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\UsuarioGithub $usuarioGithub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuarioGithub $usuarioGithub)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsuarioGithub $usuarioGithub
     * @return \Illuminate\Http\Response
     */
    public function destroy($codusuario)
    {


    }
}
