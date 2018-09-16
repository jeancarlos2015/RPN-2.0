<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 17:27
 */

namespace App\Http\Util;


use App\Http\Repositorys\LogRepository;
use Illuminate\Http\Request;

class ValidacaoLogErros
{
    public static function create_log($data)
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

    public static function validar($data)
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

    public static function exists_errors($data)
    {
        $all = $data['all'];
        $validacao = $data['validacao'];
        return \Validator::make($all, $validacao)->fails();
    }

    public static function get_errors($data)
    {
        $all = $data['all'];
        $validacao = $data['validacao'];
        return \Validator::make($all, $validacao);
    }

    public static function valida_request(Request $request)
    {
        $codmodelodeclarativo = $request->codmodelodeclarativo;
        if ($request->relacionamento === '0') {
            if (empty($request->sbOne) && empty($request->sbTwo)) {
                $dado['tipo'] = 'success';
                $dado['mensagem'] = "É necessário selecionar os valores";
                self::create_log($dado);
                return redirect()->route('controle_padrao_create_conjunto', [
                    'codmodelodeclarativo' => $codmodelodeclarativo
                ]);
            }
        }else{
            if (empty($request->sbOne) || empty($request->sbTwo)) {
                $dado['tipo'] = 'success';
                $dado['mensagem'] = "É necessário selecionar os valores";
                self::create_log($dado);
                return redirect()->route('controle_padrao_create_conjunto', [
                    'codmodelodeclarativo' => $codmodelodeclarativo
                ]);
            }
        }
    }
}