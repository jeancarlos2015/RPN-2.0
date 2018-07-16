<?php

namespace App\Http\Util;

use Cz\Git\GitRepository;

class GitComando extends GitRepository
{
    public function checkout($name)
    {
        return parent::checkout($name)
            ->run('git checkout -f')
            ->end();
        
    }

    public function reset(){
        return parent::run("cd ");
    }

}
