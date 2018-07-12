<?php

namespace App\Http\Repositorys;

use GitWrapper\GitWrapper;

require_once('../../../vendor/autoload.php');

class GitWrapperRepository
{
    private $repositorio;

    public function get_path()
    {
        return database_path('banco');
    }

    public function git_init()
    {
        $wrapper = new GitWrapper();
        $git = $wrapper->init($this->get_path());
    }

    public function get_branch_current()
    {
        $branch = null;
        try {
            $this->repositorio = new GitRepository(self::get_path());
            $branch = $this->repositorio->getCurrentBranchName();
        } catch (GitException $ex) {

        }

        return $branch;
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

    }

    public function git_commit($mensagem)
    {

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

    }

    public function git_merge_branch($nome_branch)
    {

    }

    public function git_remove_branch($nome_branch)
    {

    }


    public function git_push()
    {

    }


}
