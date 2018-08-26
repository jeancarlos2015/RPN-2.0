<?php

namespace App\Http\Repositorys;


use App\Http\Models\Projeto;
use App\http\Models\AtribuicaoProjetoUsuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AtribuicaoProjetoUsuarioRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(AtribuicaoProjetoUsuario::class);
    }

    public static function listar()
    {
        return Cache::remember('listar_atribuicao_projeto_usuarios', 2000, function () {
            if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {
                $result = Projeto::all();
                return collect($result);
            } else if (!empty(Auth::user()->repositorio)) {
                $repositorio = Auth::user()->repositorio;
                return collect(AtribuicaoProjetoUsuario::where('codrepositorio', $repositorio->codrepositorio)
                    ->get());
            }
            return collect(array());
        });
    }

    public static function listar_por_repositorio($codrepositorio)
    {
        return Cache::remember('listar_atribuicao_projeto_usuarios', 2000, function ($codrepositorio) {
            if (Auth::user()->email === 'jeancarlospenas25@gmail.com' || Auth::user()->tipo === 'Administrador') {
                return collect(AtribuicaoProjetoUsuario::where('codrepositorio', $codrepositorio)
                    ->get());
            }
            return collect(AtribuicaoProjetoUsuario::where('codrepositorio', $codrepositorio)
                ->get());
        });
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codprojeto)
    {
        $value = AtribuicaoProjetoUsuario::findOrFail($codprojeto);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_atribuicao_projeto_usuarios');
    }

    public static function incluir(Request $request)
    {
        $value = AtribuicaoProjetoUsuario::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($codprojeto)
    {
        $value = null;
        try {
            $doc = AtribuicaoProjetoUsuario::findOrFail($codprojeto);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

    public static function atribuicao_projeto_usuario_existe($nome_do_projeto)
    {
        $projetos = self::listar();
        return $projetos->where('nome', $nome_do_projeto)->count() > 0;
    }

    public static function listar_atribuicao_projeto_usuarios(){
        return Cache::remember('listar_atribuicao_projeto_usuarios', 2000, function (){
            return AtribuicaoProjetoUsuario::get();
        });
    }
}
