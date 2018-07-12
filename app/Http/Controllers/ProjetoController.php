<?php

namespace App\Http\Controllers;

use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Repositorys\ProjetoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetoController extends Controller
{


    public function index($codorganizacao)
    {
        $organizacao = Organizacao::findOrFail($codorganizacao);
        $projetos = $organizacao->projetos;
        $titulos = Projeto::titulos();
        $tipo = 'projeto';
        return view('controle_projetos.index', compact('organizacao', 'projetos', 'titulos', 'tipo'));
    }

    public function todos_projetos()
    {
        $projetos = ProjetoRepository::listar();
        $titulos = Projeto::titulos();
        $tipo = 'projeto';
        return view('controle_projetos.index', compact('projetos', 'titulos', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return bool
     */
    private function exists($codorganizacao)
    {
        $organizacao = (new Organizacao)->where('codorganizacao', '=', $codorganizacao)->first();
        return $organizacao === null;
    }

    public function create($codorganizacao)
    {

        $dados = Projeto::dados();
        if (!$this->exists($codorganizacao)) {
            $organizacao = Organizacao::findOrFail($codorganizacao);
        } else {
            $organizacao = Organizacao::create(['nome' => 'novo', 'descricao' => 'novo']);
        }
        return view('controle_projetos.create', compact('dados', 'organizacao'));
    }


    public function store(Request $request)
    {

        $request->request->add(['codusuario' => Auth::user()->codusuario]);
        $projeto = Projeto::create($request->all());

        $codorganizacao = $request->codorganizacao;
        if (isset($projeto)) {
            flash('Projeto criado com sucesso!!');
        } else {
            flash('Projeto não foi criado!!');
        }
        return redirect()->route('controle_modelos_index', ['codorganizacao' => $codorganizacao, 'codprojeto' => $projeto->codprojeto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projeto $projeto
     * @return \Illuminate\Http\Response
     */
    public function show($codprojeto)
    {
        $projeto = Projeto::findOrFail($codprojeto);
        return redirect()->route('controle_modelos_index', ['codorganizacao' => $projeto->codorganizacao, 'codprojeto' => $codprojeto]);
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
    public function update(Request $request, $codprojeto)
    {
        $projeto = ProjetoRepository::atualizar($request, $codprojeto);
        return redirect()->route('controle_modelos_index', ['codorganizacao' => $projeto->codorganizacao, 'codprojeto' => $codprojeto]);

    }


    public function destroy($codprojeto)
    {
        $projeto = ProjetoRepository::excluir($codprojeto);
        return redirect()->route('controle_projetos_index', [
            'codorganizacao' => $projeto->codorganizacao
        ]);
    }
}
