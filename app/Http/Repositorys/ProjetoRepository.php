<?php

namespace App\Http\Repositorys;


use App\Http\Models\Projeto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProjetoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Projeto::class);
    }

    public static function listar()
    {
        return Cache::remember('listar_projetos', 2000, function () {
            return collect((new Projeto)->join('users', 'users.id', '=', 'projetos.user_id')
                ->get());
        });
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }
    public static function atualizar(Request $request, $id)
    {
        $value = Projeto::findOrFail($id);
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

    public static function excluir($id)
    {
        $value = null;
        try {
            $doc = Projeto::findOrFail($id);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

}
