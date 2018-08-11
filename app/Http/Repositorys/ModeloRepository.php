<?php

namespace App\Http\Repositorys;


use App\Http\Models\ModeloDiagramatico;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ModeloRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(ModeloDiagramatico::class);
    }

    public static function listar()
    {
        if (Auth::user()->email==='jeancarlospenas25@gmail.com'){
            return ModeloDiagramatico::all();
        }
        return ModeloDiagramatico::whereCodusuario(Auth::user()->codusuario)
            ->orWhere('visibilidade', '=', 'true')
            ->get();

    }

    public static function listar_modelo_por_projeto_organizacao($codrepositorio, $codprojeto, $codusuario)
    {
        return ModeloDiagramatico::whereCodrepositorio($codrepositorio)
            ->where('codprojeto', '=', $codprojeto)
            ->Where('visibilidade','=','true')
            ->get();
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codmodelo)
    {
        $value = ModeloDiagramatico::findOrFail($codmodelo);
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
        $value = ModeloDiagramatico::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($codmodelo)
    {
        $value = null;
        try {
            $doc = ModeloDiagramatico::findOrFail($codmodelo);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

    public static function modelo_existe($nome_do_modelo){
        $modelos = self::listar();
        return $modelos->where('nome', $nome_do_modelo)->count()>0;
    }

}
