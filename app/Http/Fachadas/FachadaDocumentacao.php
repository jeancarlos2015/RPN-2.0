<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 17:33
 */

namespace App\Http\Fachadas;


use App\Http\Models\Documentacao;
use App\Http\Repositorys\DocumentacaoRepository;
use App\Http\Util\ValidacaoLogErros;
use Illuminate\Http\Request;

class FachadaDocumentacao extends FachadaConcreta
{

    public function index($codigo1 = null, $codigo2 = null)
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
            ValidacaoLogErros::create_log($data);
        }
    }

    public function create(Request $request = null, $codigo = null)
    {
        $dados = Documentacao::dados();
        $dados[2]->rotulo = "Exemplo: http://site.seudominio.com";
        return view('controle_documentacao.create', compact('dados'));
    }


    public function store(Request $request)
    {
        try {
            $data['all'] = $request->all();
            $data['validacao'] = Documentacao::validacao();
            $data['rota'] = 'controle_documentacoes.create';
            ValidacaoLogErros::validar($data);
            $request->request->add(['cod_usuario' => \Auth::user()->cod_usuario]);
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
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function show($coddocumentacao = null)
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
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request = null, $coddocumentacao = null)
    {
        try {
            $repositorio = DocumentacaoRepository::atualizar($request, $coddocumentacao);
            if (isset($repositorio)) {
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
            ValidacaoLogErros::create_log($data);
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
            ValidacaoLogErros::create_log($data);
        }
    }
}