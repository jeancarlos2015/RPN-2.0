<?php

namespace App\Http\Util;

use Cz\Git\GitException;
use Cz\Git\GitRepository;
use GrahamCampbell\GitHub\GitHubManager;

class GitComando
{
    protected $github;
    public function __construct(GitHubManager $github)
    {
        $this->github = $github;
    }

    public function projetos()
    {
        $this->github->issues()->show('jeancarlos2015', 'projetos', 2);
    }

}
