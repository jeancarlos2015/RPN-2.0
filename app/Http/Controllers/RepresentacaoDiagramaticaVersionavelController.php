<?php

namespace App\Http\Controllers;

use App\RepresentacaoDiagramaticaVersionavel;
use Illuminate\Http\Request;

class RepresentacaoDiagramaticaVersionavelController extends ControllerAbstrata
{
    function __construct()
    {
        parent::__construct('representacao_diagramatica_versionavel');
    }
}
