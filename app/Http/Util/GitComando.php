<?php

namespace App\Http\Util;

use Cz\Git\GitException;
use Cz\Git\GitRepository;

class GitComando extends GitRepository
{
    public function checkout($name)
    {
        return parent::checkout($name)
            ->run('git checkout '.$name)
            ->end();
    }

    public function reset(){
        try {
            return $this->run('git reset --hard');
        } catch (GitException $e) {
            dd($e->getMessage());
        }
    }

}
