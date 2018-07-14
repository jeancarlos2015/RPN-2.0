<?php

namespace App\Http\Repositorys;


use App\Http\Models\Modelo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ModeloRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Modelo::class);
    }

    public static function listar()
    {

            return collect((new Modelo)->join('users', 'users.codusuario', '=', 'modelos.codusuario')
                ->where('users.codusuario','=',Auth::user()->codusuario)
                ->get());

    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codmodelo)
    {
        $value = Modelo::findOrFail($codmodelo);
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
        $value = Modelo::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($codmodelo)
    {
        $value = null;
        try {
            $doc = Modelo::findOrFail($codmodelo);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

}