<?php

namespace App\Http\Controllers;


use App\Http\Models\UsuarioGithub;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
        try {
            $erros = \Validator::make($request->all(), UsuarioGithub::validacao());
            $usuario_github = null;
            if ($erros->fails()) {
                return redirect()->route('create_github', ['codusuario' => Auth::user()->codusuario])
                    ->withErrors($erros)
                    ->withInput();
            }
            try {

                $data = [
                    'usuario_github' => Crypt::encrypt($request->usuario_github),
                    'codusuario' => $request->codusuario,
                    'email_github' => $request->email_github,
                    'token_github' => bcrypt($request->token_github),
                    'branch_atual' => 'Nenhuma Branch',
                    'repositorio_atual' => 'Nenhum Repositório',
                    'senha_github' => Crypt::encrypt($request->senha_github)
                ];
                GitSistemaRepository::delete_all_github();
                UsuarioGithub::create($data);
                LogRepository::criar("Dados Salvo Com sucesso", "Rota De Configuração Github");
                flash('Configuração salva com sucesso!!');
            } catch (\Exception $ex) {
                flash($ex->getMessage())->error();
            }
            return redirect()->route('create_github', ['codusuario' => Auth::user()->codusuario]);
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar($ex->getMessage(), 'warning');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
            return redirect()->route('painel');
        }

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
