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
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->type==='Administrador') {
            return collect(ModeloDeclarativo::all());
        }
        return collect(ModeloDeclarativo::
            where('codusuario','=',Auth::user()->codusuario)
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
        $value = ModeloDeclarativo::findOrFail($codmodelo)->update($request->all());
        return $value;
    }

    public static function incluir(Request $request)
    {
        return ModeloDeclarativo::create($request->all());
    }


    public static function excluir($codmodelo)
    {
        $value = null;
        try {
            $value = ModeloDeclarativo::findOrFail($codmodelo)->delete();
        } catch (Exception $e) {

        }
        return $value;
    }


    public static function existe($nome_do_modelo)
    {
        return self::listar()->where('nome', $nome_do_modelo)->count() > 0;
    }

}
