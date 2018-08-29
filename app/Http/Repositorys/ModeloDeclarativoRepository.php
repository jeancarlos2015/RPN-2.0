<?php

namespace App\Http\Repositorys;


use App\Http\Models\ModeloDeclarativo;
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
        return Cache::remember('listar_modelos', 2000, function () {
            if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {
                return collect(ModeloDeclarativo::all());
            }
            return collect(ModeloDeclarativo::
            where('cod_usuario', '=', Auth::user()->cod_usuario)
                ->orWhere('visibilidade', '=', 'true')
                ->get());
        });
    }


    public static function listar_modelo_por_projeto_organizacao()
    {
        return Cache::remember('listar_modelos', 2000, function () {
            return collect(ModeloDeclarativo::get());
        });
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_modelos');
        Cache::forget('listar_modelos_publicos');
    }

    public static function atualizar(Request $request, $codmodelo)
    {
        $value = ModeloDeclarativo::findOrFail($codmodelo)->update($request->all());
        self::limpar_cache();
        return $value;
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
            $value = ModeloDeclarativo::findOrFail($codmodelo)->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }


    public static function existe($nome_do_modelo)
    {
        return self::listar()->where('nome', $nome_do_modelo)->count() > 0;
    }

    public static function listar_modelos()
    {
        return Cache::remember('listar_modelos', 2000, function () {
            return ModeloDeclarativo::get();
        });
    }



}
