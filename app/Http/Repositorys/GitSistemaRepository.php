<?php
namespace App\Http\Repositorys;

use Cz\Git\GitException;
use Cz\Git\GitRepository;

class GitSistemaRepository
{
    private $repositorio;

    public function get_path(){
      return  database_path('banco/');
    }
    public function git_init()
    {
        $branch = self::get_branch_current();
        $change = self::is_exchanges();

        try {
            $this->repositorio = new GitRepository(self::get_path());
            $this->repositorio = GitRepository::init(self::get_path());
            LogRepository::criar('Repositório Inicializado!!!', 'Versionamento');
        } catch (\Exception $ex) {
            LogRepository::criar($ex->getMessage(), 'Versionamento');
        }
        $resultado['branch'] = $branch;
        $resultado['change'] = $change;

        return $resultado;
    }

    public function get_branch_current()
    {
        $branch = null;
        try {
            $this->repositorio = new GitRepository(self::get_path());
            return $this->repositorio->getCurrentBranchName();
        } catch (GitException $ex) {
            return $branch;
        }

    }

    public function is_exchanges()
    {
        $exchange = null;
        try {
            $this->repositorio = new GitRepository(self::get_path());
            $exchange = $this->repositorio->hasChanges();
        } catch (GitException $ex) {

        }

        return $exchange;
    }

    public function get_branchs()
    {
        $branchs = null;
        try {
            self::inicialize_repository();
            $branchs = $this->repositorio->getBranches();
        } catch (GitException $ex) {

        }

        return $branchs;
    }

    public function git_commit($mensagem)
    {
        $branch = null;
        $change = null;
        try {
            self::inicialize_repository();
            $this->repositorio->addFile(self::get_path() . '/.');
            $this->repositorio->commit($mensagem);
            $branch = $this->repositorio->getCurrentBranchName();
            $change = $this->repositorio->hasChanges();
        } catch (\Exception $ex) {
        }
        $resultado['branch'] = $branch;
        $resultado['change'] = $change;

        return $resultado;
    }


    private function inicialize_repository()
    {
        try {
            $this->repositorio = new GitRepository(self::get_path());

        } catch (GitException $e) {
        }
        return $this->repositorio;
    }

    public function git_create_branch($nome_branch)
    {
        $branchs = null;
        $branch = null;
        $change = null;
        try {
            self::inicialize_repository();
            $branchs = $this->repositorio->getBranches();
            $this->repositorio->createBranch($nome_branch, TRUE);
            $branch = $this->repositorio->getCurrentBranchName();
            $change = $this->repositorio->hasChanges();
        } catch (GitException $ex) {

        }
        $resultado['branchs'] = $branchs;
        $resultado['branch'] = $branch;
        $resultado['change'] = $change;

        return $resultado;
    }

    public function git_checkout_branch($nome_branch)
    {
        $branch = null;
        $change = null;
        try {
            $this->repositorio = new GitRepository(self::get_path());

            $this->repositorio->checkout($nome_branch);
            $branch = $this->repositorio->getCurrentBranchName();
            $change = $this->repositorio->hasChanges();
            if ($change){

            }
        } catch (GitException $ex) {

        }
        $resultado['branch'] = $branch;
        $resultado['change'] = $change;

        return $resultado;
    }

    public function git_merge_branch($nome_branch)
    {
        $branch = self::get_branch_current();
        $change = self::is_exchanges();
        $branchs = self::get_branchs();
        self::inicialize_repository();
        if (empty($branchs)) {
            $branchs = ['nenhum'];
        }
        try {
            $this->repositorio->merge($nome_branch);
            $this->repositorio->addFile(self::get_path() . '/.');
            $this->repositorio->commit('commit');
        } catch (GitException $ex) {

        }
        $resultado['branchs'] = $branchs;
        $resultado['branch'] = $branch;
        $resultado['change'] = $change;

        return $resultado;
    }

    public function git_remove_branch($nome_branch)
    {
        $branch = self::get_branch_current();
        $change = self::is_exchanges();
        try {
            self::inicialize_repository();
            $this->repositorio->removeBranch($nome_branch);

        } catch (GitException $ex) {

        }
        $resultado['branch'] = $branch;
        $resultado['change'] = $change;

        return $resultado;
    }


    /**
     * @param $dado
     * @throws GitException
     */
    public function git_push($dado){
        $url = $dado['url'];
        $parametros = $dado['parametros'];
        $repositorio = self::inicialize_repository();
        $repositorio->commit("push");
        $repositorio->push($url,$parametros);
    }

    /**
     * @param $dado
     * @throws GitException
     */
    public function git_pull($dado){
        $url = $dado['url'];
        $parametros = $dado['parametros'];
        $nome = $dado['nome'];
        $repositorio = self::inicialize_repository();
        $repositorio->commit("push");
        $repositorio->pull($url,$parametros);
    }


}
