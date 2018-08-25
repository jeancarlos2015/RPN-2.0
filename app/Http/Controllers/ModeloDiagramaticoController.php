<?php

namespace App\Http\Controllers;

use App\Http\Models\ModeloDeclarativo;
use App\Http\Models\ModeloDiagramatico;
use App\Http\Models\Projeto;
use App\Http\Models\Repositorio;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloDeclarativoRepository;
use App\Http\Repositorys\ModeloDiagramaticoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeloDiagramaticoController extends Controller
{

    public function index($codrepositorio, $codprojeto, $codusuario)
    {

        try {
            $projeto = Projeto::findOrFail($codprojeto);
            $repositorio = $projeto->repositorio;
            $titulos = ModeloDiagramatico::titulos();
            $modelos_declarativos = $projeto->modelos_declarativos;
            $modelos_diagramaticos = $projeto->modelos_diagramaticos;
            $modelos = $modelos_declarativos->merge($modelos_diagramaticos);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        $tipo = 'modelo_diagramatico';
        return view('controle_modelos_diagramaticos.index', compact('modelos', 'projeto', 'repositorio', 'titulos', 'tipo'));
    }

    public function todos_modelos()
    {
        try {
            $modelos_diagramaticos = ModeloDiagramaticoRepository::listar();
            $modelos = $modelos_diagramaticos->merge(ModeloDeclarativoRepository::listar());
            $titulos = ModeloDiagramatico::titulos();
            $tipo = 'modelo_diagramatico';
            $log = LogRepository::log();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }

        return view('controle_modelos_diagramaticos.index_todos_modelos', compact('modelos', 'titulos', 'tipo', 'log'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function escolhe_modelo(Request $request)
    {
        $dado['tipo'] = $request->tipo;
        $dado['nome'] = $request->nome;
        $dado['descricao'] = $request->descricao;
        $dado['codprojeto'] = $request->codprojeto;
        $dado['codrepositorio'] = $request->codrepositorio;
        try {
            $projeto = Projeto::findOrFail($request->codprojeto);
            $repositorio = Repositorio::findOrFail($request->codrepositorio);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return view('controle_modelos_diagramaticos.create', compact('dado', 'projeto', 'repositorio'));
    }

    public function create($codrepositorio, $codprojeto)
    {
        try {
            $projeto = Projeto::findOrFail($codprojeto);
            $repositorio = Repositorio::findOrFail($codrepositorio);
            $dados = ModeloDiagramatico::dados();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return view('controle_modelos_diagramaticos.create', compact('dados', 'repositorio', 'projeto'));
    }

    public function edicao_modelo_diagramatico($codmodelo)
    {
        $modelo = ModeloDiagramatico::findOrFail($codmodelo);
        $path_modelo = public_path('novo_bpmn/');
        if (!file_exists($path_modelo)) {
            mkdir($path_modelo, 777);
        }
        $file = $path_modelo . 'novo.bpmn';
        file_put_contents($file, $modelo->xml_modelo);
        sleep(2);
        return view('controle_modelos_diagramaticos.modeler', compact('modelo'));
    }

//$codrepositorio, $codprojeto, $codmodelo
    public
    function store(Request $request)
    {
        try {

            $codprojeto = $request->codprojeto;
            $codrepositorio = $request->codrepositorio;
            $data['all'] = $request->all();
            $data['validacao'] = ModeloDiagramatico::validacao();
            if (!$this->exists_errors($data)) {
                if (!ModeloDiagramaticoRepository::existe($request->nome)) {
                    $request->request->add([
                        'xml_modelo' => ModeloDiagramatico::get_modelo_default($request->nome),
                        'codprojeto' => $codprojeto,
                        'codrepositorio' => $codrepositorio,
                        'codusuario' => Auth::user()->codusuario
                    ]);
                    $modelo = ModeloDiagramatico::create($request->all());
                    $data['tipo'] = 'success';
                    $this->create_log($data);
                    return redirect()->route('edicao_modelo_diagramatico',
                        ['codmodelodiagramatico' => $modelo->codmodelodiagramatico]);

                } else {
                    $data['tipo'] = 'existe';
                    $this->create_log($data);
                    return redirect()->route('controle_modelos_diagramaticos_create', [
                        'codrepositorio' => $codrepositorio,
                        'codprojeto' => $codprojeto
                    ]);
                }

            }
            $erros = $this->get_errors($data);
            return redirect()->route('controle_modelos_diagramaticos_create', [
                'codrepositorio' => $codrepositorio,
                'codprojeto' => $codprojeto
            ])
                ->withErrors($erros)
                ->withInput();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }

        return view('controle_modelos_diagramaticos.modeler', compact('modelo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($codmodelo)
    {
        try {
            $modelo = ModeloDiagramatico::findOrFail($codmodelo);
            $path_modelo = public_path('novo_bpmn/');
            if (!file_exists($path_modelo)) {
                mkdir($path_modelo, 777);
            }
            $file = $path_modelo . 'novo.bpmn';
            file_put_contents($file, $modelo->xml_modelo);
            sleep(2);
            return view('controle_modelos_diagramaticos.visualizar_modelo', compact('modelo'));

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($codmodelo)
    {
        try {
            $modelo = ModeloDiagramatico::findOrFail($codmodelo);

            $dados = ModeloDiagramatico::dados();
            $projeto = $modelo->projeto;
            $repositorio = $modelo->repositorio;

            $dados[0]->valor = $modelo->nome;
            $dados[1]->valor = $modelo->descricao;
            $dados[2]->valor = $modelo->tipo;

            return view('controle_modelos_diagramaticos.edit', compact('dados', 'modelo', 'projeto', 'repositorio'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        try {

            $modelo = ModeloDiagramatico::findOrFail($id);
            $xml_modelo = str_replace($modelo->nome, $request->nome, $modelo->xml_modelo);
            $modelo->xml_modelo = $xml_modelo;
            $modelo->update($request->all());
            if ($modelo->tipo === 'diagramatico') {
                return redirect()->route('edicao_modelo_diagramatico', [
                    'codmodelodiagramatico' => $modelo->codmodelodiagramatico
                ]);
            }

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    private
    function delete($codmodelo)
    {
        try {
            $modelo = ModeloDiagramaticoRepository::excluir($codmodelo);
            return $modelo;
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
    }

    public
    function destroy($codprojeto)
    {
        try {

            $modelo = ModeloDiagramatico::findOrFail($codprojeto);
            $modelo->delete();
            flash('Operação feita com sucesso!!');
            if (empty($modelo->codprojeto) || empty($modelo->codrepositorio)) {

                return redirect()->route('todos_modelos');
            } else {
                return redirect()->route('controle_modelos_diagramaticos_index',
                    [

                        'codrepositorio' => $modelo->codrepositorio,
                        'codprojeto' => $modelo->codprojeto,
                        'codusuario' => Auth::user()->codusuario
                    ]
                );
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');

    }

    public function gravar(Request $request)
    {
        $codmodelo = $request->codmodelodiagramatico;
        $xml = $request->strXml;
        $modelo = ModeloDiagramatico::findOrFail($codmodelo);
        $modelo->xml_modelo = $xml . "\n";
        $result = $modelo->update();
        return \Response::json($result);
    }
}
