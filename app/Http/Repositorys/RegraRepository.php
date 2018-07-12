<?php

namespace App\Http\Repositorys;


use App\Http\Models\Regra;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RegraRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Regra::class);
    }

    public static function listar()
    {

        return collect((new Regra)->join('users', 'users.codusuario', '=', 'regras.codusuario')
            ->where('users.codusuario', '=', Auth::user()->codusuario)
            ->get());

    }

    public static function listar_regras_por_modelo($codorganizacao, $codprojeto, $codmodelo)
    {
        return collect(Regra::join('users', 'users.codusuario', '=', 'regras.codusuario')
            ->where('regras.codorganizacao', '=', $codorganizacao)
            ->where('regras.codprojeto', '=', $codprojeto)
            ->where('regras.codmodelo', '=', $codmodelo)
            ->get());

    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codregra)
    {
        $value = Regra::findOrFail($codregra);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_regras');
    }

    public static function incluir(Request $request)
    {
        $value = Regra::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($codregra)
    {
        $value = null;
        try {
            $doc = Regra::findOrFail($codregra);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

}
