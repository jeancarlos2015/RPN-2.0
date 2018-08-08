<?php

namespace App\Http\Repositorys;


use App\Http\Models\Organizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrganizacaoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Organizacao::class);
    }

    public static function listar()
    {
        if (Auth::user()->email==='jeancarlospenas25@gmail.com'){
            return Organizacao::all();
        }

        return collect(array());
    }


    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codorganizacao)
    {
        $value = Organizacao::findOrFail($codorganizacao);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_organizacoes');
    }

    public static function incluir(Request $request)
    {
        $value = Organizacao::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function findOrFail($codorganizacao)
    {

    }

    public static function excluir($codorganizacao)
    {
        $doc = Organizacao::findOrFail($codorganizacao);
        $value = $doc->delete();
        self::limpar_cache();
        return $value;
    }

    public static function excluir_todos()
    {
        $organizacoes = Organizacao::all();
        foreach ($organizacoes as $organizacao) {
            $organizacao->delete();
        }
    }

    public static function organizacao_existe($nome_da_organizacao)
    {
        $organizacoes = self::listar();
        return $organizacoes->where('nome', $nome_da_organizacao)->count() > 0;
    }
}
