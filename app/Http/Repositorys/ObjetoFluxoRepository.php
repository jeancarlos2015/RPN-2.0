<?php

namespace App\Http\Repositorys;


use App\Http\Models\ObjetoFluxo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ObjetoFluxoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(ObjetoFluxo::class);
    }


    public static function listar()
    {
        return Cache::remember('listar_objetos', 2000, function () {
            if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {
                return collect(ObjetoFluxo::all());
            }
            return collect(ObjetoFluxo::whereCodusuario(Auth::user()->cod_usuario)
                ->orWhere('visibilidade', '=', 'true')
                ->get());
        });
    }
    public static function listar_por_modelo_declarativo($codmodelodeclarativo)
    {
        return Cache::remember('listar_objetos', 2000, function ($codmodelodeclarativo) {
            if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {
                return collect(ObjetoFluxo::where('cod_modelo_declarativo', '=', $codmodelodeclarativo)->get());
            }
            return collect(ObjetoFluxo::where('cod_modelo_declarativo', '=', $codmodelodeclarativo)
                ->get());
        });
    }

    public static function listar_modelo_por_projeto_organizacao($codrepositorio, $codprojeto, $codusuario)
    {
        return Cache::remember('listar_objetos', 2000, function ($codrepositorio, $codprojeto) {
            return collect(ObjetoFluxo::whereCodrepositorio($codrepositorio)
                ->where('cod_projeto', '=', $codprojeto)
                ->Where('visibilidade', '=', 'true')
                ->get());
        });
    }


    public static function atualizar(Request $request, $codobjetofluxo)
    {
        $value = ObjetoFluxo::findOrFail($codobjetofluxo);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }


    public static function incluir(Request $request)
    {
        $value = ObjetoFluxo::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function incluir_se_existe($dado)
    {
        if (!self::existe($dado['nome'])){
            return ObjetoFluxo::create($dado);
        }
        return null;
    }

    public static function excluir($codobjetofluxo)
    {
        $value = null;
        try {
            $doc = ObjetoFluxo::findOrFail($codobjetofluxo);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }
    public static function limpar_cache()
    {
        Cache::forget('listar_objetos');
    }

    public static function existe($nome_do_objeto)
    {

        $objetos = self::listar();
        return $objetos->where('nome', $nome_do_objeto)->count() > 0;

    }

    public static function listar_objetos_fluxo($codmodelodeclarativo)
    {
        return Cache::remember('listar_objetos', 2000, function ($codmodelodeclarativo) {
            return ObjetoFluxo::where('cod_modelo_declarativo', '=', $codmodelodeclarativo)
                ->get();
        });
    }


}
