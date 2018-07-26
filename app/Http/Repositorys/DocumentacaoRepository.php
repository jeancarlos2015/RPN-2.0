<?php

namespace App\Http\Repositorys;


use App\Http\Models\Documentacao;
use App\Http\Models\Organizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DocumentacaoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Organizacao::class);
    }

    public static function listar()
    {
        return Documentacao::all();
    }


    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $coddocumentacao)
    {
        $value = Documentacao::findOrFail($coddocumentacao);
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
        $value = Documentacao::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($coddocumentacao)
    {
        $doc = Documentacao::findOrFail($coddocumentacao);
        $value = $doc->delete();
        flash('Documentação excluida com sucesso!!!');
        self::limpar_cache();
        return $value;
    }

    public static function excluir_todos()
    {
        $documentacoes = Documentacao::all();
        foreach ($documentacoes as $documentacao) {
            $documentacao->delete();
        }
    }

}
