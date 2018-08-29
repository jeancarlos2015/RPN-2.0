<?php

namespace App\Http\Controllers;

use App\AtribuicaoRepositorioUsuario;
use App\http\Models\Repositorio;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\Mail\EmailVinculacaoUsuario;
use App\User;
use Illuminate\Http\Request;

class AtribuicaoRepositorioUsuarioController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AtribuicaoRepositorioUsuario  $atribuicaoRepositorioUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(AtribuicaoRepositorioUsuario $atribuicaoRepositorioUsuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AtribuicaoRepositorioUsuario  $atribuicaoRepositorioUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit(AtribuicaoRepositorioUsuario $atribuicaoRepositorioUsuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AtribuicaoRepositorioUsuario  $atribuicaoRepositorioUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtribuicaoRepositorioUsuario $atribuicaoRepositorioUsuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AtribuicaoRepositorioUsuario  $atribuicaoRepositorioUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtribuicaoRepositorioUsuario $atribuicaoRepositorioUsuario)
    {
        //
    }

    public function edit_vinculo($codusuario)
    {
        $usuario = User::findOrFail($codusuario);
        $repositorios = RepositorioRepository::listar();
        return view('controle_usuario.vinculo', compact('usuario', 'repositorios'));
    }

    public function desvincular_usuario_repositorio(Request $request)
    {

        try {
            if ($request->desvincular === 'true') {
                $user = User::findOrFail($request->codusuario);
                $repositorio = $user->repositorio;
                $user->cod_repositorio = null;
                $user->update();
                \Mail::to($user->email)->send(new EmailVinculacaoUsuario($repositorio));
            }
            $data['tipo'] = 'success';
            $this->create_log($data);
            return redirect()->route('vinculo_usuario_repositorio');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'desvincular_usuario_repositorio';
            $this->create_log($data);
            return redirect()->route('controle_usuarios.edit', ['id' => $request->codusuario]);
        }



    }

    public function vinculo_usuario_repositorio()
    {
        $repositorios = RepositorioRepository::listar();
        $usuarios = User::all();
        $titulos = User::titulos();
        $tipo = 'usuario';
        return view('vinculo_usuario_repositorio.vinculo_usuario_repositorio', compact('repositorios', 'usuarios', 'titulos', 'tipo'));
    }

    public function vincular_usuario_repositorio(Request $request)
    {
        $codusuario = $request->codusuario;
        $codrepositorio = $request->cod_repositorio;
        try {
            $repositorio = Repositorio::findOrFail($codrepositorio);
            $usuario = UserRepository::vincular($codusuario, $codrepositorio);
            $data['tipo'] = 'success';
            $this->create_log($data);
            \Mail::to($usuario->email)->send(new EmailVinculacaoUsuario($repositorio));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'vincular_usuario_repositorio';
            $this->create_log($data);
        }
        if (!empty($request->vinculo)){
            return redirect()->route('vinculo_usuario_repositorio');
        }
        return redirect()->route('controle_usuarios.edit',['id' => $codusuario]);
    }

}
