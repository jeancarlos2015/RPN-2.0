<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ModeloDeclarativoRepository;
use App\Http\Repositorys\ModeloDiagramaticoRepository;
use App\Http\Repositorys\ObjetoFluxoRepository;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\RegraRepository;
use App\Http\Repositorys\RepositorioRepository;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{
    private function rotas()
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {
            return [
                'todos_modelos',
                'todos_projetos',
                'controle_repositorios.index',
                'controle_objetos_fluxos.index',
                'todas_regras'
            ];
        } else if (!empty(Auth::user()->repositorio) && Auth::user()->tipo === 'Padrao') {
            return [
                'todos_modelos',
                'todos_projetos',
                'controle_objetos_fluxos.index',
                'todas_regras'
            ];
        }
        return [];

    }


    private function quantidades()
    {
        $qt_organizacoes = RepositorioRepository::listar()->count();
        $qt_projetos = ProjetoRepository::listar()->count();
        $qt_modelos_diagramaticos = ModeloDiagramaticoRepository::listar()->count();
        $qt_modelos_declarativos = ModeloDeclarativoRepository::listar()->count();
        $qt_modelos = $qt_modelos_declarativos + $qt_modelos_diagramaticos;
        $qt_objetos_fluxos = ObjetoFluxoRepository::listar()->count();
        $qt_regras = RegraRepository::listar()->count();
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {

            return [
                $qt_modelos,
                $qt_projetos,
                $qt_organizacoes,
                $qt_objetos_fluxos,
                $qt_regras,
            ];
        } else if (!empty(Auth::user()->repositorio) && Auth::user()->tipo === 'Padrao') {
            return [
                $qt_modelos,
                $qt_projetos,
                $qt_objetos_fluxos,
                $qt_regras,
            ];
        }
        return 0;
    }


    private function titulos()
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {
            return [
                'Todos os Modelos',
                'Todos os Projetos',
                'Todos os Repositórios',
                'Todos os Objetos de Fluxos',
                'Todas as Regras'
            ];
        } else if (!empty(Auth::user()->repositorio) && Auth::user()->tipo === 'Padrao') {
            return [
                'Todos os Modelos',
                'Todos os Projetos',
                'Todos os Objetos de Fluxos',
                'Todas as Regras'
            ];
        }
        return [];
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
            if (empty(Auth::user()->repositorio) && Auth::user()->email !== 'jeancarlospenas25@gmail.com' && Auth::user()->tipo !== 'Administrador') {
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





}
