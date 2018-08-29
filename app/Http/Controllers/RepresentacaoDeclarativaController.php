<?php

namespace App\Http\Controllers;

use App\http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\RepresentacaoDeclarativaRepository;
use Illuminate\Http\Request;

class RepresentacaoDeclarativaController extends Controller
{
    public function index()
    {

    }


    public function show($codmodelodeclarativo)
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
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $codmodelodeclarativo)
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
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($id)
    {
        try {
            RepresentacaoDeclarativaRepository::excluir($id);
            $data['tipo'] = 'success';
            $this->create_log($data);
            return redirect()->route('todos_modelos');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
            return redirect()->route('painel');
        }
    }
}
