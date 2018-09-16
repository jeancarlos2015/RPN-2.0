<?php

namespace App\Http\Controllers;

use App\Http\Models\Documentacao;
use App\Http\Repositorys\DocumentacaoRepository;
use Illuminate\Http\Request;

class DocumentacaoController extends ControllerAbstrata
{
    function __construct()
    {
        parent::__construct('documentacao');
    }


}
