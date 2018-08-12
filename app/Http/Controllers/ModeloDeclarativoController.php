<?php

namespace App\Http\Controllers;


use App\Http\Models\ModeloDeclarativo;
use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Repositorys\ModeloDeclarativoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeloDeclarativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($codrepositorio, $codprojeto)
    {
        $titulos = ModeloDeclarativo::titulos();
        $dados = ModeloDeclarativo::dados();
        $tipo = 'modelo_declarativo';
        $repositorio = Repositorio::findOrFail($codrepositorio);
        $projeto = Projeto::findOrFail($codprojeto);
        return view('controle_modelos_declarativos.modelos_declarativos.create',
            compact('titulos', 'dados', 'tipo', 'repositorio', 'projeto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public
    function store(Request $request)
    {
        $codprojeto = $request->codprojeto;
        $codrepositorio = $request->codrepositorio;
        $data['all'] = $request->all();
        $data['validacao'] = ModeloDeclarativo::validacao();
        if (!$this->exists_errors($data)) {
            $request->request->add(['codusuario' => Auth::user()->codusuario]);
            if (!ModeloDeclarativoRepository::existe($request->nome)) {
                $modelo = ModeloDeclarativo::create($request->all());

                return redirect()->route('controle_objetos_fluxos_create',
                    [
                        'codmodelodeclarativo' => $modelo->codmodelodeclarativo
                    ]);
            }
            return redirect()->route('controle_modelos_declarativos_create', [
                'codrepositorio' => $request->codrepositorio,
                'codprojeto' => $request->codprojeto
            ]);
        }

        $erros = $this->get_errors($data);
        return redirect()->route('controle_modelos_declarativos_create', [
            'codrepositorio' => $codrepositorio,
            'codprojeto' => $codprojeto
        ])
            ->withErrors($erros)
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModeloDeclarativo $modeloDeclarativo
     * @return \Illuminate\Http\Response
     */
    public function show(ModeloDeclarativo $modeloDeclarativo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModeloDeclarativo $modeloDeclarativo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ModeloDeclarativo $modeloDeclarativo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModeloDeclarativo $modeloDeclarativo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $modelo = ModeloDeclarativo::findOrFail($id);
            $modelo->delete();
            $data['tipo'] = 'success';
            $this->create_log($data);
            return redirect()->route('todos_modelos');
        }
        catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
            return redirect()->route('painel');
        }
    }
}
