<?php

namespace App\Http\Controllers;

use App\Http\Models\Modelo;
use App\Http\Models\Operador;
use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Models\Regra;
use App\Http\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizacaoController extends Controller
{


    public function area()
    {
        return view('controle_modelador.area');
    }


    public function index()
    {
        $organizacoes = Organizacao::join('users','users.id','=','organizacoes.user_id')
            ->get();
        $titulos = Organizacao::titulos();
        $campos = Organizacao::campos();
        $tipo = 'organizacao';
        return view('controle_organizacoes.index', compact('organizacoes', 'titulos', 'campos','tipo'));
    }

    public function painel(){
        $qt_organizacoes = Organizacao::all()->count();
        $qt_projetos = Projeto::all()->count();
        $qt_modelos = Modelo::all()->count();
        $qt_tarefas = Tarefa::all()->count();
        $qt_regras = Regra::all()->count();
        $tipo = 'painel';
        $titulos = [
            'Modelos',
            'Tarefas',
            'Regras',
            'Projetos',
            'Organizações'
            ];
        $rotas = [
            'todos_modelos',
            'todas_tarefas',
            'todas_regras',
            'todos_projetos',
            'controle_organizacoes.index'
        ];
        $quantidades = [
            $qt_modelos,
            $qt_tarefas,
            $qt_regras,
            $qt_projetos,
            $qt_organizacoes
        ];

        return view('painel.index',compact('titulos','quantidades','rotas','tipo'));
    }


    public function create_nome(Request $request)
    {

        $regras = Regra::all();
        $operadores = Operador::all();
        $tarefas = Tarefa::all();
        $nova_regra = null;
        $projeto = null;
        if (!empty($regras) && !empty($operadores) && !empty($tarefas)) {
            $projeto = Projeto::create($request->all());
            $nova_regra = new Regra();
            return view('controle_organizacoes.create_regras', compact('projeto', 'regras', 'operadores', 'tarefas', 'nova_regra'));
        }
        return view('controle_organizacoes.create_nome', compact('projeto'));
    }

    public function create_regras(Request $request, $id)
    {
        //dd($request,$id);

        $nova_regra1 = new Regra();
        $nova_regra1->id_projeto = $id;
        $nova_regra1->id_tarefa1 = $request->tarefa1;
        $nova_regra1->id_tarefa2 = $request->tarefa2;
        $nova_regra1->id_operador = $request->operador;
        $nova_regra = $nova_regra1->save();
        $projeto = Projeto::findOrFail($id);
        $regras = Regra::all();
        $operadores = Operador::all();
        $tarefas = Tarefa::all();
        return view('controle_organizacoes.create_regras', compact('projeto', 'regras', 'operadores', 'tarefas', 'nova_regra'));

    }


    public function create()
    {
        $dados = Organizacao::dados();
        return view('controle_organizacoes.create', compact('dados'));
    }


    public function store(Request $request)
    {
        $request->request->add(['user_id' => Auth::user()->id]);
        $organizacao = Organizacao::create($request->all());
        if (isset($organizacao)) {
            flash('Organização criada com sucesso!!');
        } else {
            flash('Organização não foi criada!!');
        }

        return redirect()->route('controle_projetos_index', ['organizacao_id' => $organizacao->id]);
    }


    public function show($id)
    {
        return redirect()->route('controle_projetos_index', ['organizacao_id' => $id]);
    }


    public function edit($id)
    {
        $organizacao = Organizacao::findOrFail($id);
        $dados = Organizacao::dados();
        $dados[0]->valor = $organizacao->nome;
        $dados[1]->valor = $organizacao->descricao;
        return view('controle_organizacoes.edit', compact('dados', 'organizacao'));
    }


    public function update(Request $request, $id)
    {
        $organizacao = Organizacao::findOrFail($id);
        $organizacao->update($request->all());

        if (isset($organizacao)) {
            flash('Organização Atualizada com sucesso!!');
        } else {
            flash('Organização não foi Atualizada!!');
        }

        return redirect()->route('controle_organizacoes.index');
    }


    public function destroy($id)
    {
        $organizacao = Organizacao::findOrFail($id);
        try {
            $organizacao->delete();
            flash('Organização foi excluída com sucesso!!');
        } catch (\Exception $e) {
            flash('Error!!!');
        }

        return response()->redirectToRoute('controle_organizacoes.index');
    }

    public function voltar()
    {
        redirect()->back();
    }
}
