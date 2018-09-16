<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 18:25
 */

namespace App\Http\Fachadas;


use App\http\Models\ObjetoFluxo;
use App\http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\ObjetoFluxoRepository;
use App\Http\Util\ValidacaoLogErros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaObjetoFluxo extends FachadaConcreta
{
    public function index($codigo1 = null, $codigo2 = null)
    {
        $objetos_fluxos = ObjetoFluxoRepository::listar();
        $tipo = 'objetofluxo';
        $titulos = ObjetoFluxo::titulos_da_tabela();
        return view('controle_modelos_declarativos.controle_objetos_fluxo.index', compact('objetos_fluxos', 'tipo', 'titulos'));
    }

    public function controle_objeto_fluxo_index($codmodelodeclarativo)
    {
        $objetos_fluxos = ObjetoFluxoRepository::listar_objetos_fluxo($codmodelodeclarativo);
        $tipo = 'objetofluxo';
        $titulos = ObjetoFluxo::titulos_da_tabela();
        $modelo_declarativo = RepresentacaoDeclarativa::findOrFail($codmodelodeclarativo);
        return view('controle_modelos_declarativos.controle_objetos_fluxo.index', compact('objetos_fluxos', 'tipo', 'titulos','modelo_declarativo'));
    }

    public function create(Request $request = null, $codmodelodeclarativo = null)
    {

        $modelo_declarativo = RepresentacaoDeclarativa::findOrFail($codmodelodeclarativo);
        $tipo = 'objetofluxo';
        $titulos = ObjetoFluxo::titulos_da_tabela();
        $dados = ObjetoFluxo::dados();
        $tipos = ObjetoFluxo::tipos();
        return view('controle_modelos_declarativos.controle_objetos_fluxo.create', compact('tipo', 'titulos', 'dados', 'modelo_declarativo', 'tipos'));
    }


    public function store(Request $request)
    {

        $codprojeto = $request->cod_projeto;
        $codrepositorio = $request->cod_repositorio;
        $data['all'] = $request->all();
        $data['validacao'] = ObjetoFluxo::validacao();
        if (!ValidacaoLogErros::exists_errors($data)) {
            $request->request->add(['cod_usuario' => Auth::user()->cod_usuario]);
            if (!ObjetoFluxoRepository::existe($request->nome)) {
                $objeto_fluxo = ObjetoFluxoRepository::incluir($request);
                $data['tipo'] = 'success';
                ValidacaoLogErros::create_log($data);
                return redirect()->route('controle_objeto_fluxo_index',
                    [
                        'cod_modelo_declarativo' => $objeto_fluxo->cod_modelo_declarativo
                    ]);
            }
            $data['tipo'] = 'existe';
            ValidacaoLogErros::create_log($data);
            return redirect()->route('controle_objetos_fluxos_create',
                [
                    'cod_modelo_declarativo' => $request->cod_modelo_declarativo
                ]);
        }

        $erros = ValidacaoLogErros::get_errors($data);
        return redirect()->route('controle_modelos_declarativos_create', [
            'cod_repositorio' => $codrepositorio,
            'cod_projeto' => $codprojeto
        ])
            ->withErrors($erros)
            ->withInput();
    }

    public function show($id = null)
    {
        echo "Página em construção";
    }

    public function edit($id)
    {

        try {


            $objeto_fluxo = ObjetoFluxo::findOrFail($id);
            $dados = ObjetoFluxo::dados();
            $tipos = ObjetoFluxo::tipos();
            $dados[0]->valor = $objeto_fluxo->nome;
            $dados[1]->valor = $objeto_fluxo->descricao;
            $modelo_declarativo = $objeto_fluxo->modelo;
            return view('controle_modelos_declarativos.controle_objetos_fluxo.edit', compact('dados', 'tipos', 'objeto_fluxo', 'modelo_declarativo'));

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');


    }


    public function update(Request $request = null, $id = null)
    {
        try {
            $data['all'] = $request->all();
            $data['validacao'] = ObjetoFluxo::validacao();
            if (!ValidacaoLogErros::exists_errors($data)) {
                if (ObjetoFluxoRepository::existe($request->nome)) {
                    $objeto_fluxo = ObjetoFluxoRepository::atualizar($request,$id);
                    $data['tipo'] = 'success';
                    ValidacaoLogErros::create_log($data);
                    $dados = ObjetoFluxo::dados();
                    $tipos = ObjetoFluxo::tipos();
                    $dados[0]->valor = $objeto_fluxo->nome;
                    $dados[1]->valor = $objeto_fluxo->descricao;
                    $modelo_declarativo = $objeto_fluxo->modelo;
                    return view('controle_modelos_declarativos.controle_objetos_fluxo.edit', compact('dados', 'tipos', 'objeto_fluxo', 'modelo_declarativo'));
                }else{
                    $data['tipo'] = 'success';
                    $data['mensagem'] = 'Não Existe registro com esses dados';
                    ValidacaoLogErros::create_log($data);
                }
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($codobjetofluxo)
    {
        try {
            $objetofluxo = ObjetoFluxoRepository::excluir($codobjetofluxo);
            flash('Operação feita com sucesso!!');
            return redirect()->route('controle_objetos_fluxos.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }
}