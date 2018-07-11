<?php

namespace App\Http\Controllers;

use App\Http\Models\Modelo;
use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use Illuminate\Http\Request;

class ModeloController extends Controller
{

    public function index($organizacao_id, $projeto_id)
    {

        $projeto = Projeto::findOrFail($projeto_id);
        $organizacao = Organizacao::findOrFail($organizacao_id);
        $titulos = Modelo::titulos();
        $modelos = Modelo::where('projeto_id', $projeto_id)->get();
        $tipo = 'modelo';
        return view('controle_modelos.index', compact('modelos', 'projeto', 'organizacao', 'titulos','tipo'));
    }

    public function todos_modelos()
    {

        $modelos = Modelo::all();
        $titulos = Modelo::titulos();
        return view('controle_modelos.index_todos_modelos', compact('modelos', 'titulos'));
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
        $dado['projeto_id'] = $request->projeto_id;
        $dado['organizacao_id'] = $request->organizacao_id;
        $projeto = Projeto::findOrFail($request->projeto_id);
        $organizacao = Organizacao::findOrFail($request->organizacao_id);
        return view('controle_modelos.create', compact('dado', 'projeto', 'organizacao'));
    }

    public function create($organizacao_id, $projeto_id)
    {
        $projeto = Projeto::findOrFail($projeto_id);
        $organizacao = Organizacao::findOrFail($organizacao_id);
        $dados = Modelo::dados();
        return view('controle_modelos.create', compact('dados', 'organizacao', 'projeto'));
    }


    public function store(Request $request)
    {
        $request->request->add([
            'xml_modelo' => 'nenhum',
        ]);
        $modelo = Modelo::create($request->all());
        if (isset($modelo)) {
            flash('Modelo criado com sucesso!!!');
        }
        if ($modelo->tipo === 'declarativo') {
            return redirect()->route('controle_tarefas_index',
                [
                    'organizacao_id' => $modelo->organizacao_id,
                    'projeto_id' => $modelo->projeto_id,
                    'modelo_id' => $modelo->id
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
    public function show($id)
    {
        $modelo = Modelo::findOrFail($id);
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

    public function show_tarefas($id)
    {

        $modelo = Modelo::findOrFail($id);
        if (empty($modelo->projeto->id) || empty($modelo->organizacao->id)) {
            flash('Não existem tarefas para serem exibidas!!!')->error();
            return redirect()->route('controle_modelos.show', ['id' => $modelo->id]);
        } else {
            $projeto = $modelo->projeto;
            $organizacao = $modelo->organizacao;
            return redirect()->route('controle_tarefas_index', [
                'organizacao_id' => $organizacao->id,
                'projeto_id' => $projeto->id,
                'modelo_id' => $modelo->id
            ]);
        }

    }

    public function show_regras($id)
    {
        $modelo = Modelo::findOrFail($id);
        $projeto = $modelo->projeto;
        $organizacao = $modelo->organizacao;
        if (empty($modelo->projeto->id) || empty($modelo->organizacao->id)) {
            flash('Não existem regras para serem exibidas!!!')->error();
            return redirect()->route('controle_modelos.show', ['id' => $modelo->id]);
        } else {
            return redirect()->route('controle_regras_index', [
                'organizacao_id' => $organizacao->id,
                'projeto_id' => $projeto->id,
                'modelo_id' => $modelo->id
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelo = Modelo::findOrFail($id);
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
        $organizacao = $modelo->organizacao;
        $projeto = $modelo->projeto;
        if (isset($modelo)) {
            flash('Modelo atualizado com sucesso!!');
        } else {
            flash('Modelo não foi atualizado!!');
        }
        return redirect()->route('controle_tarefas_index', [
            'organizacao_id' => $organizacao->id,
            'projeto_id' => $projeto->id,
            'modelo_id' => $modelo->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    private function delete($modelo)
    {
        try {
            $modelo->delete();
            flash('Modelo Excluído Com Sucesso !!!');
        } catch (\Exception $e) {
            flash('Modelo Excluído Não Foi Excluído !!!');
        }
        return $modelo;
    }

    public function destroy($id)
    {
        $modelo = Modelo::findOrFail($id);

        $this->delete($modelo);
        if (empty($modelo->projeto->id) || empty($modelo->organizacao->id)) {

            return redirect()->route('todos_modelos');
        } else {
            $projeto_id = $modelo->projeto->id;
            $organizacao_id = $modelo->organizacao->id;
            return redirect()->route('controle_modelos_index',
                [
                    'organizacao_id' => $organizacao_id,
                    'projeto_id' => $projeto_id
                ]
            );
        }

    }
}
