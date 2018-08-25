<?php

namespace App\Http\Controllers;

use App\Http\Models\ModeloDeclarativo;
use App\http\Models\ObjetoFluxo;
use App\Http\Repositorys\ModeloDeclarativoRepository;
use App\Http\Repositorys\ObjetoFluxoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetoFluxoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $modelo_declarativo = ModeloDeclarativo::findOrFail($codmodelodeclarativo);
        return view('controle_modelos_declarativos.controle_objetos_fluxo.index', compact('objetos_fluxos', 'tipo', 'titulos','modelo_declarativo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($codmodelodeclarativo)
    {

        $modelo_declarativo = ModeloDeclarativo::findOrFail($codmodelodeclarativo);
        $tipo = 'objetofluxo';
        $titulos = ObjetoFluxo::titulos_da_tabela();
        $dados = ObjetoFluxo::dados();
        $tipos = ObjetoFluxo::tipos();
        return view('controle_modelos_declarativos.controle_objetos_fluxo.create', compact('tipo', 'titulos', 'dados', 'modelo_declarativo', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $codprojeto = $request->codprojeto;
        $codrepositorio = $request->codrepositorio;
        $data['all'] = $request->all();
        $data['validacao'] = ObjetoFluxo::validacao();
        if (!$this->exists_errors($data)) {
            $request->request->add(['codusuario' => Auth::user()->codusuario]);
            if (!ObjetoFluxoRepository::existe($request->nome)) {
                $objeto_fluxo = ObjetoFluxoRepository::incluir($request);
                $data['tipo'] = 'success';
                $this->create_log($data);
                return redirect()->route('controle_objeto_fluxo_index',
                    [
                        'codmodelodeclarativo' => $objeto_fluxo->codmodelodeclarativo
                    ]);
            }
            $data['tipo'] = 'existe';
            $this->create_log($data);
            return redirect()->route('controle_objetos_fluxos_create',
                [
                    'codmodelodeclarativo' => $request->codmodelodeclarativo
                ]);
        }

        $erros = $this->get_errors($data);
        return redirect()->route('controle_modelos_declarativos_create', [
            'codrepositorio' => $codrepositorio,
            'codprojeto' => $codprojeto
        ])
            ->withErrors($erros)
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\http\Models\ObjetoFluxo $objetoFluxo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "Página em construção";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\http\Models\ObjetoFluxo $objetoFluxo
     * @return \Illuminate\Http\Response
     */
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
            $this->create_log($data);
        }
        return redirect()->route('painel');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\http\Models\ObjetoFluxo $objetoFluxo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data['all'] = $request->all();
            $data['validacao'] = ObjetoFluxo::validacao();
            if (!$this->exists_errors($data)) {
                if (ObjetoFluxoRepository::existe($request->nome)) {
                    $objeto_fluxo = ObjetoFluxoRepository::atualizar($request,$id);
                    $data['tipo'] = 'success';
                    $this->create_log($data);
                    $dados = ObjetoFluxo::dados();
                    $tipos = ObjetoFluxo::tipos();
                    $dados[0]->valor = $objeto_fluxo->nome;
                    $dados[1]->valor = $objeto_fluxo->descricao;
                    $modelo_declarativo = $objeto_fluxo->modelo;
                    return view('controle_modelos_declarativos.controle_objetos_fluxo.edit', compact('dados', 'tipos', 'objeto_fluxo', 'modelo_declarativo'));
                }else{
                    $data['tipo'] = 'success';
                    $data['mensagem'] = 'Não Existe registro com esses dados';
                    $this->create_log($data);
                }
            }
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\http\Models\ObjetoFluxo $objetoFluxo
     * @return \Illuminate\Http\Response
     */
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
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }
}
