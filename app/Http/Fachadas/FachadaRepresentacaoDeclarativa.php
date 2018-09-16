<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 18:32
 */

namespace App\Http\Fachadas;


use App\http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\RepresentacaoDeclarativaRepository;
use App\Http\Util\ValidacaoLogErros;
use Illuminate\Http\Request;

class FachadaRepresentacaoDeclarativa extends FachadaConcreta
{
    public function show($codmodelodeclarativo = null)
    {
        return redirect()->route('painel_modelo_declarativo',[$codmodelodeclarativo]);
    }

    public function edit($id)
    {
        try {
            $modelo = RepresentacaoDeclarativa::findOrFail($id);

            $dados = RepresentacaoDeclarativa::dados();
            $projeto = $modelo->projeto;
            $repositorio = $modelo->repositorio;

            $dados[0]->valor = $modelo->nome;
            $dados[1]->valor = $modelo->descricao;
            $dados[2]->valor = $modelo->tipo;

            return view('controle_modelos_declarativos.modelos_declarativos.edit', compact('dados', 'modelo', 'projeto', 'repositorio'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request = null, $codmodelodeclarativo = null)
    {

        try {

            $modelo = RepresentacaoDeclarativaRepository::atualizar($request, $codmodelodeclarativo);
            return redirect()->route('edicao_modelo_declarativo', [
                'cod_modelo_declarativo' => $modelo->cod_modelo_declarativo
            ]);

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($id)
    {
        try {
            RepresentacaoDeclarativaRepository::excluir($id);
            $data['tipo'] = 'success';
            ValidacaoLogErros::create_log($data);
            return redirect()->route('todos_modelos');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
            return redirect()->route('painel');
        }
    }

}