<?php

namespace App\Http\Controllers;

use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Models\Regra;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\OrganizacaoRepository;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\RegraRepository;
use App\Http\Repositorys\TarefaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrganizacaoController extends Controller
{


    public function area()
    {
        return view('controle_modelador.area');
    }


    public function index()
    {
        $organizacoes = OrganizacaoRepository::listar();
        $titulos = Organizacao::titulos();
        $campos = Organizacao::campos();
        $tipo = 'organizacao';
        return view('controle_organizacoes.index', compact('organizacoes', 'titulos', 'campos', 'tipo'));
    }

    public function painel()
    {
        $qt_organizacoes = OrganizacaoRepository::count();
        $qt_projetos = ProjetoRepository::count();
        $qt_modelos = ModeloRepository::count();
        $qt_tarefas = TarefaRepository::count();
        $qt_regras = RegraRepository::count();
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

        return view('painel.index', compact('titulos', 'quantidades', 'rotas', 'tipo'));
    }


    public function create_nome(Request $request)
    {

        $regras = RegraRepository::listar();
        $tarefas = TarefaRepository::listar();
        $nova_regra = null;
        $projeto = null;
        if (!empty($regras) && !empty($tarefas)) {
            $projeto = Projeto::create($request->all());
            $nova_regra = new Regra();
            return view('controle_organizacoes.create_regras', compact('projeto', 'regras', 'operadores', 'tarefas', 'nova_regra'));
        }
        return view('controle_organizacoes.create_nome', compact('projeto'));
    }

    public function create_regras(Request $request)
    {

        return view('controle_organizacoes.create_regras', compact('projeto', 'regras', 'operadores', 'tarefas', 'nova_regra'));

    }


    public function create()
    {
        $dados = Organizacao::dados();
        return view('controle_organizacoes.create', compact('dados'));
    }



    public function store(Request $request)
    {
        $status = Validator::make($request->all(), [Organizacao::regras_validacao()]);
        if ($status->fails()){

        }
        $request->request->add(['codusuario' => Auth::user()->codusuario]);
        $organizacao = Organizacao::create($request->all());

        if (isset($organizacao)) {
            flash('Organização criada com sucesso!!');
        } else {
            flash('Organização não foi criada!!');
        }

        return redirect()->route('controle_projetos_index', ['codorganizacao' => $organizacao->codorganizacao]);
    }


    public function show($codorganizacao)
    {
        return redirect()->route('controle_projetos_index', ['codorganizacao' => $codorganizacao]);
    }


    public function edit($id)
    {
        $organizacao = Organizacao::findOrFail($id);
        $dados = Organizacao::dados();
        $dados[0]->valor = $organizacao->nome;
        $dados[1]->valor = $organizacao->descricao;
        return view('controle_organizacoes.edit', compact('dados', 'organizacao'));
    }


    public function update(Request $request, $codorganizacao)
    {

        $organizacao = OrganizacaoRepository::atualizar($request, $codorganizacao);
        if (isset($organizacao)) {
            flash('Organização Atualizada com sucesso!!');
        } else {
            flash('Organização não foi Atualizada!!');
        }

        return redirect()->route('controle_organizacoes.index');
    }


    public function destroy($codorganizacao)
    {

        $organizacao = OrganizacaoRepository::excluir($codorganizacao);
        return response()->redirectToRoute('controle_organizacoes.index');
    }

    public function voltar()
    {
        redirect()->back();
    }
}
