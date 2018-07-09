<?php
namespace App\Http\Repositories;

use Cz\Git\GitException;
use Cz\Git\GitRepository;

class VersionamentoRepository
{
    private $repositorio;

    public function _construct(){
        $this->path = "database";
        $this->repositorio = new GitRepository(public_path($this->path));
    }

    public function git_init()
    {
        $branch = self::get_branch_current();
        $change = self::is_exchanges();
        try {
            $this->repositorio = new GitRepository(public_path($this->path));
            $this->repositorio = GitRepository::init(public_path($this->path));
        } catch (\Exception $ex) {
        }

        $resultado['branch'] = $branch;
        $resultado['change'] = $change;

        return $resultado;
    }

    public function get_branch_current()
    {
        $branch = null;
        try {
            $this->repositorio = new GitRepository(public_path($this->path));
            $branch = $this->repositorio->getCurrentBranchName();
        } catch (GitException $ex) {

        }

        return $branch;
    }

    public function is_exchanges()
    {
        $exchange = null;
        try {
            $this->repositorio = new GitRepository(public_path($this->path));
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
            $this->repositorio->addFile(public_path($this->path) . '/.');
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
            $this->repositorio = new GitRepository(public_path($this->path));
        } catch (GitException $e) {
        }
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
            self::inicialize_repository();
            $this->repositorio->checkout($nome_branch);
            $branch = $this->repositorio->getCurrentBranchName();
            $change = $this->repositorio->hasChanges();
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
            $this->repositorio->addFile(public_path($this->path) . '/.');
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



}
