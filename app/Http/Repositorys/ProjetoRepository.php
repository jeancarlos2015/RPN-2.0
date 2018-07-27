<?php

namespace App\Http\Repositorys;


use App\Http\Models\Projeto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProjetoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Projeto::class);
    }

    public static function listar()
    {

        return Projeto::all()
            ->where('codusuario', '=', Auth::user()->codusuario);

    }

    public static function listar_por_organizacao($codorganizacao)
    {
        return Projeto::all()
            ->where('codusuario', '=', Auth::user()->codusuario)
            ->where('codorganizacao', '=', $codorganizacao);

    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codprojeto)
    {
        $value = Projeto::findOrFail($codprojeto);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_projetos');
    }

    public static function incluir(Request $request)
    {
        $value = Projeto::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($codprojeto)
    {
        $value = null;
        try {
            $doc = Projeto::findOrFail($codprojeto);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

}
