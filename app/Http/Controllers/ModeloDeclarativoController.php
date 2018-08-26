<?php

namespace App\Http\Controllers;


use App\Http\Models\ModeloDeclarativo;
use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Repositorys\ModeloDeclarativoRepository;
use App\Http\Repositorys\ObjetoFluxoRepository;
use App\Http\Repositorys\RegraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeloDeclarativoController extends Controller
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
            $modelo = ModeloDeclarativo::findOrFail($id);

            $dados = ModeloDeclarativo::dados();
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

            $modelo = ModeloDeclarativoRepository::atualizar($request, $codmodelodeclarativo);
            return redirect()->route('edicao_modelo_declarativo', [
                'codmodelodeclarativo' => $modelo->codmodelodeclarativo
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
            ModeloDeclarativoRepository::excluir($id);
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
