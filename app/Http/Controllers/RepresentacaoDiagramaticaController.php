<?php

namespace App\Http\Controllers;

use App\RepresentacaoDiagramatica;
use Illuminate\Http\Request;

class RepresentacaoDiagramaticaController extends ControllerAbstrata
{
    function __construct()
    {
        parent::__construct('representacao_diagramatica');
    }
}
