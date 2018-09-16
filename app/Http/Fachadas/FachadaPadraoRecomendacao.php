<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 02:46
 */

namespace App\Http\Fachadas;


use App\http\Models\ObjetoFluxo;
use App\http\Models\Regra;
use App\Http\Repositorys\ObjetoFluxoRepository;
use App\Http\Repositorys\RegraRepository;
use App\Http\Repositorys\RepresentacaoDeclarativaRepository;
use App\Http\Util\ValidacaoLogErros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaPadraoRecomendacao extends FachadaConcreta
{

    public static function make($tipo)
    {
        switch ($tipo) {
            case 'binario':
                return new FachadaPadraoRecomendacaoBinario();
            case 'conjunto':
                return new FachadaPadraoRecomendacaoConjunto();
            default:
                return new FachadaPadraoRecomendacao();
        }
    }

    private function salvar($dado)
    {
        if (!empty($dado['id_objetos_fluxos1']) && !empty($dado['id_objetos_fluxos2'])) {
            $id_objetos_fluxos1 = $dado['id_objetos_fluxos1'];
            $id_objetos_fluxos2 = $dado['id_objetos_fluxos2'];
            $codrepositorio = $dado['codrepositorio'];
            $codmodelodeclarativo = $dado['codmodelodeclarativo'];
            $codprojeto = $dado['codprojeto'];
            $codusaurio = $dado['codusuario'];
            $id_relacionamento = $dado['id_relacionamento'];
            $publico = $dado['publico'];
            $nome = $dado['nome'];
            $dado = [
                'codrepositorio' => $codrepositorio,
                'codusuario' => $codusaurio,
                'codprojeto' => $codprojeto,
                'codmodelodeclarativo' => $codmodelodeclarativo,
                'codoutraregra' => 0,
                'nome' => $nome,
                'tipo' => Regra::PADROES[$id_relacionamento],
                'publico' => $publico,
                'descricao' => Regra::PADROES[$id_relacionamento],
                'relacionamento' => $id_relacionamento
            ];
            $regra = RegraRepository::inclui_se_existe($dado);
            RegraRepository::limpar_cache();
            ObjetoFluxoRepository::incluir_se_existe($dado);
            for ($id_objeto = 0; $id_objeto < count($id_objetos_fluxos1); $id_objeto++) {
                if (!empty($regra)) {
                    $objetofluxo1 = ObjetoFluxo::findOrFail($id_objetos_fluxos1[$id_objeto]);
                    $objetofluxo2 = ObjetoFluxo::findOrFail($id_objetos_fluxos2[$id_objeto]);
                    $objetofluxo1->codregra = $regra->codregra;
                    $objetofluxo2->codregra = $regra->codregra;
                    $objetofluxo1->update();
                    $objetofluxo2->update();
                }
            }

        }

    }


    public function store(Request $request)
    {
        $codmodelodeclarativo = $request->codmodelodeclarativo;
        ValidacaoLogErros::valida_request($request);
        $modelo = RepresentacaoDeclarativaRepository::findOrFail($codmodelodeclarativo);
        $dado['codmodelodeclarativo'] = $request->codmodelodeclarativo;
        $dado['id_relacionamento'] = $request->relacionamento;
        $dado['codobjetofluxo'] = $modelo->codobjetofluxo;
        $dado['codusuario'] = Auth::user()->codusuario;
        $dado['codprojeto'] = $modelo->codprojeto;
        $dado['codrepositorio'] = $modelo->codrepositorio;
        $dado['publico'] = $request->publico;
        $dado['id_objetos_fluxos1'] = $request->sbOne;
        $dado['id_objetos_fluxos2'] = $request->sbTwo;
        $dado['nome'] = $request->nome;
        if (count($request->sbOne) == count($request->sbTwo)) {
            self::salvar($dado);
            $data['tipo'] = 'success';
            ValidacaoLogErros::create_log($data);
        }

        return redirect()->route('controle_padrao_create_conjunto', [
            'codmodelodeclarativo' => $codmodelodeclarativo
        ]);
    }


}