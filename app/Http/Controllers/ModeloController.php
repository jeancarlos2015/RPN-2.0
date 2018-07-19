<?php

namespace App\Http\Controllers;

use App\Http\Models\Modelo;
use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeloController extends Controller
{

    public function index($codorganizacao, $codprojeto)
    {

        $projeto = Projeto::findOrFail($codprojeto);
        $organizacao = Organizacao::findOrFail($codorganizacao);
        $titulos = Modelo::titulos();
        $modelos = ModeloRepository::listar_modelo_por_projeto_organizacao($codorganizacao, $codprojeto);
        $tipo = 'modelo';
        return view('controle_modelos.index', compact('modelos', 'projeto', 'organizacao', 'titulos', 'tipo'));
    }

    public function todos_modelos()
    {

        $modelos = ModeloRepository::listar();
        $titulos = Modelo::titulos();
        $tipo = 'modelo';
        $log = LogRepository::log();
        return view('controle_modelos.index_todos_modelos', compact('modelos', 'titulos','tipo','log'));
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
        $dado['codorganizacao'] = $request->codorganizacao;
        $projeto = Projeto::findOrFail($request->codprojeto);
        $organizacao = Organizacao::findOrFail($request->codorganizacao);
        return view('controle_modelos.create', compact('dado', 'projeto', 'organizacao'));
    }

    public function create($codorganizacao, $codprojeto)
    {
        $projeto = Projeto::findOrFail($codprojeto);
        $organizacao = Organizacao::findOrFail($codorganizacao);
        $dados = Modelo::dados();
        return view('controle_modelos.create', compact('dados', 'organizacao', 'projeto'));
    }


    public function store(Request $request)
    {
        $codprojeto = $request->codprojeto;
        $codorganizacao = $request->codorganizacao;
        $request->request->add([
            'xml_modelo' => 'nenhum',
            'codusuario' => Auth::user()->codusuario
        ]); 

        $erros = \Validator::make($request->all(), Modelo::validacao());
        if ($erros->fails()){
            return redirect()->route('controle_modelos_create', [
                'codorganizacao' => $codorganizacao,
                'codprojeto' => $codprojeto
            ])
            ->withErrors($erros)
            ->withInput();
        }

        $modelo = Modelo::create($request->all());

        if ($modelo->tipo === 'declarativo') {
            flash('Modelo criado com sucesso!!!');
            return redirect()->route('controle_regras_index',
                [
                    'codorganizacao' => $modelo->codorganizacao,
                    'codprojeto' => $modelo->codprojeto,
                    'codmodelo' => $modelo->codmodelo
                ]);
        } else {
            return view('controle_modelos.form_diagramatico', compact('modelo'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($codmodelo)
    {
        $modelo = Modelo::findOrFail($codmodelo);
        $projeto = $modelo->projeto;
        $organizacao = $modelo->organizacao;
        if ($modelo->tipo === 'declarativo') {
            return view('controle_modelos.form_declarativo', compact(
                'modelo',
                'projeto',
                'organizacao'
            ));
        } else {
            return view('controle_modelos.form_diagramatico', compact('modelo'));
        }

    }

    public function show_tarefas($codmodelo)
    {

        $modelo = Modelo::findOrFail($codmodelo);
        if (empty($modelo->codprojeto) || empty($modelo->codorganizacao)) {
            flash('Não existem tarefas para serem exibidas!!!')->error();
            return redirect()->route('controle_modelos.show', ['id' => $codmodelo]);
        } else {
            return redirect()->route('controle_tarefas_index', [
                'codorganizacao' => $modelo->codorganizacao,
                'codprojeto' => $modelo->codprojeto,
                'codmodelo' => $modelo->codmodelo
            ]);
        }

    }

    public function show_regras($codmodelo)
    {
        $modelo = Modelo::findOrFail($codmodelo);
        if (empty($modelo->codprojeto) || empty($modelo->codorganizacao)) {
            flash('Não existem regras para serem exibidas!!!')->error();
            return redirect()->route('controle_modelos.show', ['id' => $codmodelo]);
        } else {
            return redirect()->route('controle_regras_index', [
                'codorganizacao' => $modelo->codorganizacao,
                'codprojeto' => $modelo->codprojeto,
                'codmodelo' => $modelo->codmodelo
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($codmodelo)
    {
        $modelo = Modelo::findOrFail($codmodelo);
        $dados = Modelo::dados();
        $projeto = $modelo->projeto;
        $organizacao = $modelo->organizacao;
        $dados[0]->valor = $modelo->nome;
        $dados[1]->valor = $modelo->descricao;
        $dados[2]->valor = $modelo->tipo;
        return view('controle_modelos.edit', compact('dados', 'modelo', 'projeto', 'organizacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->update($request->all());
        if (isset($modelo)) {
            flash('Modelo atualizado com sucesso!!');
        } else {
            flash('Modelo não foi atualizado!!');
        }
        return redirect()->route('controle_tarefas_index', [
            'codorganizacao' => $modelo->codorganizacao,
            'codprojeto' => $modelo->codprojeto,
            'codmodelo' => $modelo->codmodelo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    private function delete($codmodelo)
    {
        $modelo = ModeloRepository::excluir($codmodelo);
        return $modelo;
    }

    public function destroy($codprojeto)
    {
        $modelo = Modelo::findOrFail($codprojeto);

        $this->delete($modelo);
        if (empty($modelo->codprojeto) || empty($modelo->codorganizacao)) {

            return redirect()->route('todos_modelos');
        } else {
            return redirect()->route('controle_modelos_index',
                [
                    'codorganizacao' => $modelo->codorganizacao,
                    'codprojeto' => $modelo->codprojeto
                ]
            );
        }

    }
}
