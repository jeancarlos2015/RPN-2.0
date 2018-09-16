<?php

namespace App\Http\Controllers;

use App\Http\Models\Log;
use App\Http\Repositorys\LogRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class LogController extends ControllerAbstrata
{
    function __construct()
    {
        parent::__construct('log');
    }


}
