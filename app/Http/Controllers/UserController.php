<?php

namespace App\Http\Controllers;

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
        $erros = \Validator::make($request->all(), Organizacao::validacao());
        if ($erros->fails()){
            return redirect()->route('controle_organizacoes.create')
                ->withErrors($erros)
                ->withInput();
        }
        $request->request->add(['codusuario' => Auth::user()->codusuario]);
        $organizacao = Organizacao::create($request->all());
        LogRepository::criar("Organização Criada Com sucesso", "Rota De Criação de organização");
        if (isset($organizacao)) {
            flash('Organização criada com sucesso!!');
        } else {
            flash('Organização não foi criada!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
