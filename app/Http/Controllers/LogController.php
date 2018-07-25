<?php

namespace App\Http\Controllers;

use App\Http\Models\Log;
use App\Http\Repositorys\LogRepository;
use Illuminate\Http\Request;

class LogController extends Controller
{
//'nome',
//'descricao',
//'codusuario'
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulos = [
            'código',
            'descricao',
            'Usuário'
        ];
        $tipo = 'log';
        $logs = LogRepository::listar();
        return view('controle_logs.logs',compact('titulos','logs','tipo'));
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
        $log = Log::findOrFail($id);
        try {
            $log->delete();
            flash('Log removido com sucesso!!!');
        } catch (\Exception $e) {
            LogRepository::criar($e->getMessage(), 'error');
        }
        return redirect()->route('controle_logs.index');
    }
}
