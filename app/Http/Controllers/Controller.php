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
        if ($data['tipo'] === 'success') {
            if (!empty($data['mensagem'])) {
                flash($data['mensagem'])->warning();
            } else {
                flash('A operação feita com sucesso!!!');
            }
        } else if ($data['tipo'] === 'existe') {
            flash('Este registro já existe')->warning();
        } else {
            $codigo = LogRepository::criar(
                $data['mensagem'],
                $data['tipo'],
                $data['pagina'],
                $data['acao']);
            if ($data['tipo'] === 'error') {
                flash('A operação gerou o log de código ' . $codigo . ', favor consultar na página "Logs Do Sistema", se for um conflito de merger será necessário resolver o conflito no github')->error();
            } else {
                flash('A operação gerou o log de código ' . $codigo . ', favor consultar na página "Logs Do Sistema"')->warning();
            }

            return $codigo;
        }

    }

    protected function validar($data)
    {
        $all = $data['all'];
        $validacao = $data['validacao'];
        $rota = $data['rota'];
        $erros = \Validator::make($all, $validacao);
        if ($erros->fails()) {
            return redirect()->route($rota)
                ->withErrors($erros)
                ->withInput();
        }
    }

    protected function exists_errors($data)
    {
        $all = $data['all'];
        $validacao = $data['validacao'];
        return \Validator::make($all, $validacao)->fails();
    }

    protected function get_errors($data)
    {
        $all = $data['all'];
        $validacao = $data['validacao'];
        return \Validator::make($all, $validacao);
    }
}
