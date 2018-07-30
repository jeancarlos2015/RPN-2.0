<?php

namespace App\Http\Controllers;

use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Models\Regra;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\OrganizacaoRepository;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\RegraRepository;
use App\Http\Repositorys\TarefaRepository;
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
        try {
            $organizacoes = OrganizacaoRepository::listar();
            $titulos = Organizacao::titulos();
            $campos = Organizacao::campos();
            $tipo = 'organizacao';
            $log = LogRepository::log();
            return view('controle_organizacoes.index', compact('organizacoes', 'titulos', 'campos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
    }

    private function rotas()
    {
        return [
            'todos_modelos',
            'todas_tarefas',
            'todas_regras',
            'todos_projetos',
            'controle_organizacoes.index',
        ];
    }

    private function titulos()
    {
        return [
            'Modelos',
            'Tarefas',
            'Regras',
            'Projetos',
            'Organizações'
        ];
    }

    private function quantidades()
    {
        $qt_organizacoes = OrganizacaoRepository::count();
        $qt_projetos = ProjetoRepository::count();
        $qt_modelos = ModeloRepository::count();
        $qt_tarefas = TarefaRepository::count();
        $qt_regras = RegraRepository::count();
        $qt_funcionalidades = 6;
        return [
            $qt_modelos,
            $qt_tarefas,
            $qt_regras,
            $qt_projetos,
            $qt_organizacoes
        ];
    }

    public function painel()
    {
        try {
            $repositorio_atual = Auth::user()->github->repositorio_atual;
            GitSistemaRepository::atualizar_todas_branchs($repositorio_atual);
            $log = LogRepository::log();
            $tipo = 'painel';
            $titulos = $this->titulos();
            $rotas = $this->rotas();
            $quantidades = $this->quantidades();
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return view('painel.index', compact('titulos', 'quantidades', 'rotas', 'tipo', 'log'));
    }


    public function create_nome(Request $request)
    {
        try {
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
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
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
        try {
            $erros = \Validator::make($request->all(), Organizacao::validacao());
            if ($erros->fails()) {
                return redirect()->route('controle_organizacoes.create')
                    ->withErrors($erros)
                    ->withInput();
            }
            $request->request->add(['codusuario' => Auth::user()->codusuario]);
            $organizacao = Organizacao::create($request->all());
            if (isset($organizacao)) {
                flash('Organização criada com sucesso!!');
            } else {
                flash('Organização não foi criada!!');
            }

            return redirect()->route('controle_projetos_index', ['codorganizacao' => $organizacao->codorganizacao]);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function show($codorganizacao)
    {
        return redirect()->route('controle_projetos_index', ['codorganizacao' => $codorganizacao]);
    }


    public function edit($id)
    {
        try {
            $organizacao = Organizacao::findOrFail($id);
            $dados = Organizacao::dados();
            $dados[0]->valor = $organizacao->nome;
            $dados[1]->valor = $organizacao->descricao;
            return view('controle_organizacoes.edit', compact('dados', 'organizacao'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $codorganizacao)
    {
        try {
            $organizacao = OrganizacaoRepository::atualizar($request, $codorganizacao);
            if (isset($organizacao)) {
                flash('Organização Atualizada com sucesso!!');
            } else {
                flash('Organização não foi Atualizada!!');
            }

            return redirect()->route('controle_organizacoes.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($codorganizacao)
    {
        try {
            OrganizacaoRepository::excluir($codorganizacao);

            flash('Operação feita com sucesso!!');
            return response()->redirectToRoute('controle_organizacoes.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
    }

}
