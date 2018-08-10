<?php

namespace App\Http\Repositorys;


use App\Http\Models\Repositorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RepositorioRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Repositorio::class);
    }

    public static function listar()
    {
        if (Auth::user()->email==='jeancarlospenas25@gmail.com'){
            return Repositorio::all();
        }

        return collect(array());
    }


    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codrepositorio)
    {
        $value = Repositorio::findOrFail($codrepositorio);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_repositorios');
    }

    public static function incluir(Request $request)
    {
        $value = Repositorio::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function findOrFail($codrepositorio)
    {

    }

    public static function excluir($codrepositorio)
    {
        $doc = Repositorio::findOrFail($codrepositorio);
        $value = $doc->delete();
        self::limpar_cache();
        return $value;
    }

    public static function excluir_todos()
    {
        $repositorios = Repositorio::all();
        foreach ($repositorios as $repositorio) {
            $repositorio->delete();
        }
    }

    public static function repositorio_existe($nome_do_repositorio)
    {
        $repositorios = self::listar();
        return $repositorios->where('nome', $nome_do_repositorio)->count() > 0;
    }
}