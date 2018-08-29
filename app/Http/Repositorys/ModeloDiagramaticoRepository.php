<?php

namespace App\Http\Repositorys;


use App\Http\Models\ModeloDiagramatico;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ModeloDiagramaticoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(ModeloDiagramatico::class);
    }

    public static function listar()
    {
        return Cache::remember('listar_modelos', 2000, function () {
            if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {
                return collect(ModeloDiagramatico::all());
            }else{
                return collect(ModeloDiagramatico::
                where('cod_usuario', '=', Auth::user()->cod_usuario)
                    ->orWhere('visibilidade', '=', true)
                    ->get());
            }

        });

    }
    public static function listar_modelos_publicos()
    {
        return Cache::remember('listar_modelos_publicos', 2000, function () {
            return collect(ModeloDiagramatico::where('publico', '=', 'true')
                ->get());
        });
    }

    public static function listar_modelo_por_projeto_organizacao($codrepositorio, $codprojeto, $codusuario)
    {
        return Cache::remember('listar_modelos', 2000, function ($codrepositorio, $codprojeto) {
            return collect(ModeloDiagramatico::
            where('cod_repositorio', '=', $codrepositorio)
                ->where('cod_projeto', '=', $codprojeto)
                ->Where('visibilidade', '=', 'true')
                ->get());
        });
    }


    public static function atualizar(Request $request, $codmodelo)
    {
        $modelo = ModeloDiagramatico::findOrFail($codmodelo);
        $xml_modelo = str_replace($modelo->nome, $request->nome, $modelo->xml_modelo);
        $modelo->xml_modelo = $xml_modelo;
        $modelo->update($request->all());
        self::limpar_cache();
        return $modelo;
    }


    public static function limpar_cache()
    {
        Cache::forget('listar_modelos');
        Cache::forget('listar_modelos_publicos');
        Cache::forget('listar_codigos_modelos');
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


    public static function existe($nome_do_modelo)
    {

        $modelos = self::listar();
        return $modelos->where('nome', $nome_do_modelo)->count() > 0;

    }

    public static function get_codigos(){
        return Cache::remember('listar_codigos_modelos', 2000, function (){
            return DB::connection('banco')->table('modelos_diagramaticos')
                ->select('cod_modelo_diagramatico')
                ->get();
        });
    }

    public static function gravar(Request $request){
        $codmodelo = $request->cod_modelo_diagramatico;
        $xml = $request->strXml;
        $modelo = ModeloDiagramatico::findOrFail($codmodelo);
        $modelo->xml_modelo = $xml . "\n";
        $result = $modelo->update();
        self::limpar_cache();
        return $request;
    }

    public static function visualizar_modelos_publicos($codmodelo){
        $modelo = ModeloDiagramatico::findOrFail($codmodelo);
        $path_modelo = public_path('novo_bpmn/');
        if (!file_exists($path_modelo)) {
            mkdir($path_modelo, 777);
        }
        $file = $path_modelo . 'novo.bpmn';
        file_put_contents($file, $modelo->xml_modelo);
        sleep(2);
        return $modelo;
    }

}
