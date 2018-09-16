<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\RepositorioRepository;
use App\Http\Repositorys\UserRepository;
use App\Mail\EmailCadastroDeUsuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;

class UserController extends ControllerAbstrata
{
    function __construct()
    {
        parent::__construct('usuario');
    }



}
