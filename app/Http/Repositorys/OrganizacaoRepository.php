<?php

namespace App\Http\Repositorys;


use App\Http\Models\Organizacao;
use Exception;
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

        return collect((new Organizacao)->join('users', 'users.codusuario', '=', 'organizacoes.codusuario')
            ->where('users.codusuario', '=', Auth::user()->codusuario)
            ->get());

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
        $value = null;
        try {

            $doc = Organizacao::findOrFail($codorganizacao);
            dd($codorganizacao);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

}
