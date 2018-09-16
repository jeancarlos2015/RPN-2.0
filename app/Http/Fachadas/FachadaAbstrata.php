<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 17:24
 */

namespace App\Http\Fachadas;


use Illuminate\Http\Request;

abstract class FachadaAbstrata
{

    abstract public function index($codigo1 = null, $codigo2 = null);
    abstract public function store(Request $request);
    abstract public function update(Request $request, $codigo = null);
    abstract public function destroy($codigo);
    abstract public function edit($codigo);
    abstract public function show($codigo = null);
    abstract public function all();
    abstract public function create(Request $request = null, $codigo = null);


    abstract public function pull();
    abstract public function delete(Request $request);
    abstract public function edit_repository(Request $request);
    abstract public function delete_repository($repositorio_atual);
    abstract public function criar_base(Request $request);
    abstract public function selecionar_repositorio($repositorio_atual, $default_branch);
    abstract public function index_init();
    abstract public function index_pull_push();
    abstract public function index_commit_branch();
    abstract public function index_create_delete();
    abstract public function index_merge_checkout();



    public static function make($tipo){
        switch ($tipo){
            case 'repositorio':
                return new FachadaRepositorio();
            case 'documentacao':
                return new FachadaDocumentacao();
            case 'usuario':
                return new FachadaUsuario();
            case 'log':
                return new FachadaLog();
            case 'representacao_declarativa':
                return new FachadaRepresentacaoDeclarativa();
            case 'representacao_diagramatica':
                return new FachadaRepresentacaoDiagramatica();
            case 'representacao_diagramatica_versionavel':
                return new FachadaRepresentacaoDiagramaticaVersionavel();
            case 'usuario_github':
                return new FachadaUsuarioGithub();
            case 'git':
                return new FachadaGit();
            default:
                return new FachadaConcreta();
        }
    }
}