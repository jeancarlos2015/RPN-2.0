<?php

namespace App\Http\Controllers;


use App\Http\Models\ModeloDeclarativo;
use App\Http\Models\ModeloDiagramatico;
use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Repositorys\ModeloDeclarativoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeloDeclarativoController extends Controller
{

    public function index()
    {

    }

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

                return redirect()->route('controle_objeto_fluxo_index',
                    [
                        'codmodelodeclarativo' => $modelo->codmodelodeclarativo
                    ]);
            }
            $data['tipo'] = 'existe';
            $this->create_log($data);
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


    public function show(ModeloDeclarativo $modeloDeclarativo)
    {
        dd(null);
    }

    public function edit($id)
    {
        try {
            $modelo = ModeloDeclarativo::findOrFail($id);

            $dados = ModeloDeclarativo::dados();
            $projeto = $modelo->projeto;
            $repositorio = $modelo->repositorio;

            $dados[0]->valor = $modelo->nome;
            $dados[1]->valor = $modelo->descricao;
            $dados[2]->valor = $modelo->tipo;

            return view('controle_modelos_declarativos.modelos_declarativos.edit', compact('dados', 'modelo', 'projeto', 'repositorio'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $codmodelodeclarativo)
    {
        dd(null);
        try {

            $modelo = ModeloDeclarativo::findOrFail($codmodelodeclarativo);
            $modelo->update($request->all());
            return redirect()->route('edicao_modelo_declarativo', [
                'codmodelodeclarativo' => $modelo->codmodelodeclarativo
            ]);

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


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
