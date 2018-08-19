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
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com') {
            return collect(ObjetoFluxo::all());
        }
        return collect(ObjetoFluxo::whereCodusuario(Auth::user()->codusuario)
            ->orWhere('visibilidade', '=', 'true')
            ->get());

    }


    public static function listar_modelo_por_projeto_organizacao($codrepositorio, $codprojeto, $codusuario)
    {
        return collect(ObjetoFluxo::whereCodrepositorio($codrepositorio)
            ->where('codprojeto', '=', $codprojeto)
            ->Where('visibilidade', '=', 'true')
            ->get());
    }


    public static function atualizar(Request $request, $codobjetofluxo)
    {
        $value = ObjetoFluxo::findOrFail($codobjetofluxo);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_objetos');
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
            $value = ObjetoFluxo::create($dado);
        }
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


    public static function existe($nome_do_objeto)
    {

        $objetos = self::listar();
        return $objetos->where('nome', $nome_do_objeto)->count() > 0;

    }

}
