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
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com') {
            return Regra::all();
        }
        return collect(array());
    }

    public static function listar_Regras_publicos()
    {
        return Regra::wherePublico(true)
            ->get();
    }

    public static function inclui_se_existe($dados)
    {


        if (!self::existe($dados)) {
            $regra1 = Regra::create($dados);
        }
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codRegra)
    {
        $value = Regra::findOrFail($codRegra);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_Regras');
    }

    public static function incluir(Request $request)
    {
        $value = Regra::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function findOrFail($codRegra)
    {

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
    }

    public static function existe($dados)
    {
        $Regras = self::listar();
        return  $Regras
                ->where('codobjetofluxo', $dados['codobjetofluxo'])
                ->where('relacionamento',$dados['relacionamento'])
                ->count() > 0;

    }
}
