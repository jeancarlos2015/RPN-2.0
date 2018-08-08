<?php

namespace App\Http\Controllers;

use App\Http\Models\Documentacao;
use App\Http\Repositorys\DocumentacaoRepository;
use Illuminate\Http\Request;

class DocumentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $documentacoes = DocumentacaoRepository::listar();
            $titulos = Documentacao::titulos();
            $campos = Documentacao::campos();
            $tipo = 'documentacao';
            return view('controle_documentacao.index', compact('documentacoes', 'titulos', 'campos', 'tipo'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
    }

    public function create()
    {
        $dados = Documentacao::dados();
        return view('controle_documentacao.create', compact('dados'));
    }


    public function store(Request $request)
    {
        try {
            $data['all'] = $request->all();
            $data['validacao'] = Documentacao::validacao();
            $data['rota'] = 'controle_documentacoes.create';
            $this->validar($data);
            $request->request->add(['codusuario' => \Auth::user()->codusuario]);
            $documentacao = DocumentacaoRepository::incluir($request);
            if (isset($documentacao)) {
                flash('Documentação criada com sucesso!!');
            } else {
                flash('Documentação não foi criada!!');
            }
            return redirect()->route('controle_documentacoes.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function show($coddocumentacao)
    {
        return redirect()->route('controle_documentacoes.index');
    }


    public function edit($id)
    {
        try {
            $documentacao = Documentacao::findOrFail($id);
            $dados = Documentacao::dados();
            $dados[0]->valor = $documentacao->nome;
            $dados[1]->valor = $documentacao->descricao;
            $dados[2]->valor = $documentacao->link;
            return view('controle_documentacao.edit', compact('dados', 'documentacao'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $coddocumentacao)
    {
        try {
            $organizacao = DocumentacaoRepository::atualizar($request, $coddocumentacao);
            if (isset($organizacao)) {
                flash('Documentação Atualizada com sucesso!!');
            } else {
                flash('Documentação não foi Atualizada!!');
            }
            return redirect()->route('controle_documentacoes.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($coddocumentacao)
    {
        try {
            DocumentacaoRepository::excluir($coddocumentacao);
            flash('Documentação excluida com sucesso!!!');
            return response()->redirectToRoute('controle_documentacoes.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
    }
}
