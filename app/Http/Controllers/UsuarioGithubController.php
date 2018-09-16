<?php

namespace App\Http\Controllers;


use App\Http\Models\UsuarioGithub;
use App\Http\Repositorys\BranchsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UsuarioGithubController extends ControllerAbstrata
{
    function __construct()
    {
        parent::__construct('usuario_github');
    }
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
        try{
            $erros = \Validator::make($request->all(), UsuarioGithub::validacao());
            if ($erros->fails()) {
                return redirect()->route('create_github', ['cod_usuario' => Auth::user()->cod_usuario])
                    ->withErrors($erros)
                    ->withInput();
            } else
                if (BranchsRepository::existe_usuario()) {
                    $usuario = Auth::user()->github;
                    $usuario_github = UsuarioGithub::findOrFail($usuario->cod_usuario_github);
                    $usuario_github->usuario_github = Crypt::encrypt($request->usuario_github);
                    $usuario_github->email_github = $request->email_github;
                    $usuario_github->senha_github = Crypt::encrypt($request->senha_github);
                    $usuario_github->update();
                    $data['tipo'] = 'success';
                    $this->create_log($data);
                } else {
                    $data = [
                        'usuario_github' => Crypt::encrypt($request->usuario_github),
                        'cod_usuario' => Auth::user()->cod_usuario,
                        'email_github' => $request->email_github,
                        'branch_atual' => 'nenhum',
                        'repositorio_atual' => 'nenhum',
                        'senha_github' => Crypt::encrypt($request->senha_github)
                    ];
                    UsuarioGithub::create($data);
                    $data['tipo'] = 'success';
                    $this->create_log($data);
                }

        }catch (\Exception $ex){
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Configuracao';
            $data['acao'] = 'store';
            $this->create_log($data);
        }
        return redirect()->route('create_github', ['cod_usuario' => Auth::user()->cod_usuario]);

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
    private function atualiza($data, $id)
    {
        $usuario_github = UsuarioGithub::findOrFail($id);
        $usuario_github->update($data);
    }

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
    public function destroy($id)
    {
        try {
            $usuario_github = UsuarioGithub::findOrFail($id);
            $usuario_github->delete();
            $data['tipo'] = 'success';
            $this->create_log($data);
        } catch (\Exception $e) {
            $data['mensagem'] = $e->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('create_github', ['cod_usuario' => Auth::user()->cod_usuario]);
    }
}
