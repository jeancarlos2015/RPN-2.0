<?php

namespace App\Http\Controllers;

use App\http\Models\Regra;
use App\http\Models\Repositorio;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloDeclarativoRepository;
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
            $data['acao'] = 'index';
            $this->create_log($data);
        }
    }

    private function rotas()
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador') {
            return [
                'todos_modelos',
                'todos_projetos',
                'controle_repositorios.index',
                'controle_objetos_fluxos.index',
                'todas_regras'
            ];
        } else if (!empty(Auth::user()->repositorio) && Auth::user()->tipo==='Padrao') {
            return [
                'todos_modelos',
                'todos_projetos',
                'controle_objetos_fluxos.index',
                'todas_regras'
            ];
        }
        return [];

    }

    private function titulos()
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador') {
            return [
                'Todos os Modelos',
                'Todos os Projetos',
                'Todos os Repositórios',
                'Todos os Objetos de Fluxos',
                'Todas as Regras'
            ];
        } else if (!empty(Auth::user()->repositorio) && Auth::user()->tipo==='Padrao') {
            return [
                'Todos os Modelos',
                'Todos os Projetos',
                'Todos os Objetos de Fluxos',
                'Todas as Regras'
            ];
        }
        return [];
    }

    private function quantidades()
    {
        $qt_organizacoes = RepositorioRepository::count();
        $qt_projetos = ProjetoRepository::count();
        $qt_modelos_diagramaticos = ModeloDiagramaticoRepository::listar()->count();
        $qt_modelos_declarativos =  ModeloDeclarativoRepository::listar()->count();
        $qt_modelos = $qt_modelos_declarativos + $qt_modelos_diagramaticos;
        $qt_objetos_fluxos = ObjetoFluxoRepository::count();
        $qt_regras = Regra::all()->count();
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador') {

            return [
                $qt_modelos,
                $qt_projetos,
                $qt_organizacoes,
                $qt_objetos_fluxos,
                $qt_regras,
            ];
        } else if (!empty(Auth::user()->repositorio) && Auth::user()->tipo==='Padrao') {
            return [
                $qt_modelos,
                $qt_projetos,
                $qt_objetos_fluxos,
                $qt_regras,
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
            if (empty(Auth::user()->repositorio) && Auth::user()->email!=='jeancarlospenas25@gmail.com' && Auth::user()->tipo!=='Administrador') {
                $data['mensagem'] = "Favor solicitar ao administrador que vincule sua conta a uma repositório!!";
                $data['tipo'] = 'success';
                $this->create_log($data);
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'painel';
            $this->create_log($data);
        }
        return view('painel.index', compact('titulos', 'quantidades', 'rotas', 'tipo', 'log'));
    }


    public function create()
    {
        $dados = Repositorio::dados();
        return view('controle_repositorios.create', compact('dados'));
    }

    public function desvincular_usuario_repositorio(Request $request)
    {

            try {
                if ($request->desvincular === 'true') {
                    $user = User::findOrFail($request->codusuario);
                    $repositorio = $user->repositorio;
                    $user->codrepositorio = null;
                    $user->update();
                    \Mail::to($user->email)->send(new EmailVinculacaoUsuario($repositorio));
                }
                $data['tipo'] = 'success';
                $this->create_log($data);
                return redirect()->route('vinculo_usuario_repositorio');
            } catch (\Exception $ex) {
                $data['mensagem'] = $ex->getMessage();
                $data['tipo'] = 'error';
                $data['pagina'] = 'Painel';
                $data['acao'] = 'desvincular_usuario_repositorio';
                $this->create_log($data);
                return redirect()->route('controle_usuarios.edit', ['id' => $request->codusuario]);
            }



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
                        'codrepositorio' => $repositorio->codrepositorio
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
                'codrepositorio' => $codrepositorio
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

    public function vinculo_usuario_repositorio()
    {
        $repositorios = RepositorioRepository::listar();
        $usuarios = User::all();
        $titulos = User::titulos();
        $tipo = 'usuario';
        return view('vinculo_usuario_repositorio.vinculo_usuario_repositorio', compact('repositorios', 'usuarios', 'titulos', 'tipo'));
    }

    public function vincular_usuario_repositorio(Request $request)
    {
        $codusuario = $request->codusuario;
        $codrepositorio = $request->codrepositorio;
        try {
            $repositorio = Repositorio::findOrFail($codrepositorio);
            $usuario = UserRepository::vincular($codusuario, $codrepositorio);
            $data['tipo'] = 'success';
            $this->create_log($data);
            \Mail::to($usuario->email)->send(new EmailVinculacaoUsuario($repositorio));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'vincular_usuario_repositorio';
            $this->create_log($data);
        }
        if (!empty($request->vinculo)){
            return redirect()->route('vinculo_usuario_repositorio');
        }
        return redirect()->route('controle_usuarios.edit',['id' => $codusuario]);
    }

}
