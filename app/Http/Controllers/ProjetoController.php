<?php

namespace App\Http\Controllers;

use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Repositories\VersionamentoRepository;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{



    public function index($organizacao_id)
    {
        $organizacao = Organizacao::findOrFail($organizacao_id);
        $projetos = Projeto::all()->where('organizacao_id', $organizacao_id);
        $titulos = Projeto::titulos();
        $tipo = 'projeto';
        return view('controle_projetos.index', compact('organizacao', 'projetos', 'titulos','tipo'));
    }

    public function todos_projetos()
    {
        $projetos = Projeto::all();
        $titulos = Projeto::titulos();
        $tipo = 'projeto';
        return view('controle_projetos.index', compact('projetos', 'titulos','tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return bool
     */
    private function exists($id){
        $organizacao = (new Organizacao)->where('id', '=', $id)->first();
        return $organizacao === null;
    }
    public function create($organizacao_id)
    {

        $dados = Projeto::dados();
        if(!$this->exists($organizacao_id)){
            $organizacao = Organizacao::findOrFail($organizacao_id);
        }else{
            $organizacao = Organizacao::create(['nome' => 'novo', 'descricao' => 'novo']);
        }
        return view('controle_projetos.create', compact('dados', 'organizacao'));
    }


    public function store(Request $request)
    {

        $projeto = Projeto::create($request->all());

        $organizacao_id = $request->organizacao_id;
        if (isset($projeto)) {
            flash('Projeto criado com sucesso!!');
        } else {
            flash('Projeto não foi criado!!');
        }
        return redirect()->route('controle_modelos_index', ['organizacao_id' => $organizacao_id, 'projeto_id' => $projeto->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projeto $projeto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projeto = Projeto::findOrFail($id);
        $organizacao_id = $projeto->organizacao->id;
        return redirect()->route('controle_modelos_index', ['organizacao_id' => $organizacao_id, 'projeto_id' => $projeto->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projeto $projeto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projeto = Projeto::findOrFail($id);
        $dados = Projeto::dados();
        $organizacao = $projeto->organizacao;
        $dados[0]->valor = $projeto->nome;
        $dados[1]->valor = $projeto->descricao;
        return view('controle_projetos.edit', compact('dados', 'projeto', 'organizacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Projeto $projeto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projeto = Projeto::findOrFail($id);
        $projeto->update($request->all());
        $organizacao_id = $projeto->organizacao->id;
        if (isset($projeto)) {
            flash('Projeto Atualizado com sucesso!!');
        } else {
            flash('Projeto não foi Atualizado!!');
        }
        return redirect()->route('controle_modelos_index', ['organizacao_id' => $organizacao_id, 'projeto_id' => $projeto->id]);

    }


    public function destroy($id)
    {
        $projeto = Projeto::findOrFail($id);
        try {
            $projeto->delete();
            if (!$projeto->exists) {
                flash('Projeto Excluído Com Sucesso!!!');
            } else {
                flash('Projeto Não Foi Excluído!!!');
            }

        } catch (\Exception $e) {
            flash('Error!!!')->error();
        }
        return redirect()->route('controle_projetos_index', [
            'organizacao_id' => $projeto->organizacao->id
        ]);
    }
}
