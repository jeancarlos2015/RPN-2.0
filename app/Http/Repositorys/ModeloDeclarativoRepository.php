<?php

namespace App\Http\Repositorys;


use App\Http\Models\ModeloDeclarativo;
use App\http\Models\ObjetoFluxo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ModeloDeclarativoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(ModeloDeclarativo::class);
    }


    public static function listar()
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com') {
            return collect(ModeloDeclarativo::all());
        }
        return collect(ModeloDeclarativo::whereCodusuario(Auth::user()->codusuario)
            ->orWhere('visibilidade', '=', 'true')
            ->get());

    }

    public static function listar_objetos_fluxo($codmodelodeclarativo)
    {
        return ObjetoFluxo::all()
            ->where('codmodelodeclarativo', '=', $codmodelodeclarativo);
    }

    public static function listar_modelo_por_projeto_organizacao($codrepositorio, $codprojeto, $codusuario)
    {
        return collect(ModeloDeclarativo::get());
    }


    public static function atualizar(Request $request, $codmodelo)
    {
        $value = ModeloDeclarativo::findOrFail($codmodelo);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_modelos');
    }

    public static function incluir(Request $request)
    {
        $value = ModeloDeclarativo::create($request->all());
        self::limpar_cache();
        return $value;
    }


    public static function excluir($codmodelo)
    {
        $value = null;
        try {
            $doc = ModeloDeclarativo::findOrFail($codmodelo);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }


    public static function existe($nome_do_modelo)
    {

        $modelos = self::listar();
        return $modelos->where('nome', $nome_do_modelo)->count() > 0;

    }

}
