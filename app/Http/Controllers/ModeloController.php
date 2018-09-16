<?php

namespace App\Http\Controllers;

use App\Modelo;
use Illuminate\Http\Request;

class ModeloController extends ControllerAbstrata
{
    function __construct()
    {
        parent::__construct('modelo');
    }

}
