<?php

namespace App\Http\Controllers;

use App\http\Models\Regra;
use App\http\Models\Repositorio;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\RepresentacaoDeclarativaRepository;
use App\Http\Repositorys\ModeloDiagramaticoRepository;
use App\Http\Repositorys\ObjetoFluxoRepository;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\RegraRepository;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\Mail\EmailVinculacaoUsuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Parent_;

class RepositorioController extends ControllerAbstrata
{

    function __construct()
    {
        parent::__construct('documentacao');
    }


    public function index()
    {
        try {
            $repositorios = RepositorioRepository::listar();
            $titulos = Repositorio::titulos_da_tabela();
            $campos = Repositorio::campos();
            $tipo = 'repositorio';
            $log = LogRepository::log();
            return view('controle_repositorios.index', compact('repositorios', 'titulos', 'campos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            $this->create_log($data);
        }
    }


    public function create()
    {
        $dados = Repositorio::dados();
        return view('controle_repositorios.create', compact('dados'));
    }



    public function store(Request $request)
    {
        try {

            $erros = \Validator::make($request->all(), Repositorio::validacao());
            if ($erros->fails()) {
                return redirect()->route('controle_repositorios.create')
                    ->withErrors($erros)
                    ->withInput();
            }
            if (!RepositorioRepository::repositorio_existe($request->nome)) {

                $repositorio = RepositorioRepository::incluir($request);

                if (isset($repositorio)) {
                    flash('Organização criada com sucesso!!');
                } else {
                    flash('Organização não foi criada!!');
                }

                return redirect()->route('controle_projetos_index',
                    [
                        'cod_repositorio' => $repositorio->cod_repositorio
                    ]
                );
            } else {

                $dados = Repositorio::dados();
                $repositorio = RepositorioRepository::listar()->where('nome', $request->nome)->first();
                return view('controle_repositorios.create', compact('dados','repositorio'));
            }

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'store';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function show($codrepositorio)
    {
        return redirect()->route('controle_projetos_index',
            [
                'cod_repositorio' => $codrepositorio
            ]
        );
    }


    public function edit($id)
    {
        try {
            $repositorio = Repositorio::findOrFail($id);
            $dados = Repositorio::dados();
            $dados[0]->valor = $repositorio->nome;
            $dados[1]->valor = $repositorio->descricao;
            return view('controle_repositorios.edit', compact('dados', 'repositorio'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'edit';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $codrepositorio)
    {
        try {
            $repositorio = RepositorioRepository::atualizar($request, $codrepositorio);
            if (isset($repositorio)) {
                flash('Organização Atualizada com sucesso!!');
            } else {
                flash('Organização não foi Atualizada!!');
            }
            return redirect()->route('controle_repositorios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'update';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($codrepositorio)
    {
        try {
            RepositorioRepository::excluir($codrepositorio);
            flash('Operação feita com sucesso!!');
            return response()->redirectToRoute('controle_repositorios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'destroy';
            $this->create_log($data);
        }
    }



}
