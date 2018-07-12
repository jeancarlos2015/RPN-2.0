<?php

namespace App\Http\Repositorys;


use App\Http\Models\Regra;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class RegraRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Regra::class);
    }

    public static function listar()
    {

        return collect((new Regra)->join('users', 'users.id', '=', 'regras.user_id')
            ->where('users.id','=',Auth::user()->id)
            ->get());
        
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $id)
    {
        $value = Regra::findOrFail($id);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_regras');
    }

    public static function incluir(Request $request)
    {
        $value = Regra::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($id)
    {
        $value = null;
        try {
            $doc = Regra::findOrFail($id);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

}
