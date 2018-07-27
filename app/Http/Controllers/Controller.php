<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\LogRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function create_log($data)
    {
        $codigo = LogRepository::criar(
            $data['mensagem'],
            $data['tipo'],
            $data['pagina'],
            $data['acao']);
        flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
    }
}
