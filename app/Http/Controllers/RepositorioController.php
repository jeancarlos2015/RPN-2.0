<?php

namespace App\Http\Controllers;

use App\http\Models\Repositorio;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloRepository;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\RepositorioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepositorioController extends Controller
{


    public function area()
    {
        return view('controle_modelador.area');
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
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
    }

    private function rotas()
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com') {
            return [
                'todos_modelos',
                'todos_projetos',
                'controle_repositorios.index',
            ];
        } else if (!empty(Auth::user()->repositorio)) {
            return [
                'todos_modelos',
                'todos_projetos'
            ];
        }
        return [];

    }

    private function titulos()
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com') {
            return [
                'Modelos',
                'Projetos',
                'Organizações'
            ];
        } else if (!empty(Auth::user()->repositorio)) {
            return [
                'Modelos',
                'Projetos'
            ];
        }
        return [];
    }

    private function quantidades()
    {
        $qt_organizacoes = RepositorioRepository::count();
        $qt_projetos = ProjetoRepository::count();
        $qt_modelos = ModeloRepository::count();
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com') {

            return [
                $qt_modelos,
                $qt_projetos,
                $qt_organizacoes
            ];
        } else if (!empty(Auth::user()->repositorio)) {
            return [
                $qt_modelos,
                $qt_projetos
            ];
        }
        return 0;
    }

    public function painel()
    {


        try {

            GitSistemaRepository::atualizar_todas_branchs();
            $log = LogRepository::log();
            $tipo = 'painel';
            $titulos = $this->titulos();
            $rotas = $this->rotas();
            $quantidades = $this->quantidades();
            if (count($rotas) == 0) {
                $data['mensagem'] = "Favor solicitar ao administrador que vincule sua conta a uma organização!!";
                $data['tipo'] = 'success';
                $this->create_log($data);
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return view('painel.index', compact('titulos', 'quantidades', 'rotas', 'tipo', 'log'));
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
            if (!RepositorioRepository::organizacao_existe($request->nome)) {

                $organizacao = Repositorio::create($request->all());

                if (isset($organizacao)) {
                    flash('Organização criada com sucesso!!');
                } else {
                    flash('Organização não foi criada!!');
                }

                return redirect()->route('controle_projetos_index',
                    [
                        'codrepositorio' => $organizacao->codrepositorio
                    ]
                );
            } else {
                $data['tipo'] = 'existe';
                $this->create_log($data);
                return redirect()->route('controle_repositorios.create');
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


    public function show($codrepositorio)
    {
        return redirect()->route('controle_projetos_index',
            [
                'codrepositorio' => $codrepositorio
            ]
        );
    }


    public function edit($id)
    {
        try {
            $organizacao = Repositorio::findOrFail($id);
            $dados = Repositorio::dados();
            $dados[0]->valor = $organizacao->nome;
            $dados[1]->valor = $organizacao->descricao;
            return view('controle_repositorios.edit', compact('dados', 'repositorio'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $codrepositorio)
    {
        try {
            $organizacao = RepositorioRepository::atualizar($request, $codrepositorio);
            if (isset($organizacao)) {
                flash('Organização Atualizada com sucesso!!');
            } else {
                flash('Organização não foi Atualizada!!');
            }

            return redirect()->route('controle_repositorios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
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
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
    }

}
