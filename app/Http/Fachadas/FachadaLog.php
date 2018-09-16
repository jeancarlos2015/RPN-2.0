<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 18:15
 */

namespace App\Http\Fachadas;


use App\Http\Models\Log;
use App\Http\Repositorys\LogRepository;
use App\Http\Util\ValidacaoLogErros;

class FachadaLog extends FachadaConcreta
{
    public function index($codigo1 = null, $codigo2 = null)
    {
        $titulos = [
            'Descrição',
            'Ações'
        ];
        $tipo = 'log';
        $logs = LogRepository::listar();
        return view('controle_logs.logs',compact('titulos','logs','tipo'));


    }

    public function destroy($id)
    {
        $log = Log::findOrFail($id);
        try {
            $log->delete();
            flash('Log removido com sucesso!!!');
        }
        catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('controle_logs.index');
    }

}