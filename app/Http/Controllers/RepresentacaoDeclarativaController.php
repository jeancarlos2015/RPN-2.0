<?php

namespace App\Http\Controllers;

use App\http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\RepresentacaoDeclarativaRepository;
use Illuminate\Http\Request;

class RepresentacaoDeclarativaController extends ControllerAbstrata
{
    function __construct()
    {
        parent::__construct('representacao_declarativa');
    }
}
