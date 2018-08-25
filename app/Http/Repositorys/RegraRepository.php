<?php

namespace App\Http\Repositorys;


use App\http\Models\Regra;
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
        return Cache::remember('listar_regras', 2000, function () {
            if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->type === 'Administrador') {
                return collect(Regra::all());
            } else {
                return collect(Regra::
                where('visivel_modelo_declarativo', '=', 'true')
                    ->orWhere('codusuario', '=', Auth::user()->codusuario)
                    ->get());
            }
        });
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_regras');
    }
    public static function inclui_se_existe($dados)
    {


        if (!self::existe($dados)) {
            return Regra::create($dados);
        }
        return null;
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codregra)
    {
        $regra = Regra::findOrFail($codregra);
        $regra->nome = $request->nome;
        $regra->visivel_projeto = $request->visivel_projeto;
        $regra->visivel_repositorio = $request->visivel_repositorio;
        $regra->visivel_modelo_declarativo = $request->visivel_modelo_declarativo;
        $regra->update();
        self::limpar_cache();
        return $regra;
    }
    public static function incluir(Request $request)
    {
        $value = Regra::create($request->all());
        self::limpar_cache();
        return $value;
    }


    public static function excluir($codRegra)
    {
        $doc = Regra::findOrFail($codRegra);
        $value = $doc->delete();
        self::limpar_cache();
        return $value;
    }

    public static function excluir_todos()
    {
        $Regras = Regra::all();
        foreach ($Regras as $Regra) {
            $Regra->delete();
        }
        self::limpar_cache();
    }

    public static function existe($dados)
    {

        return  collect(Regra::where('nome','=',$dados['nome'])
                ->get())
                ->count() > 0;
    }
}
