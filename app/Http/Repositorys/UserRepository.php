<?php

namespace App\Http\Repositorys;


use App\http\Models\Repositorio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(User::class);
    }

    public function listar_usuarios()
    {
        return Cache::remember('listar_usuarios', 2000, function () {
            return User::get();
        });
    }

    public static function listar()
    {
        return self::listar_usuarios();
    }

    public static function atualizar(Request $request, $codmodelo)
    {
        $user = User::findOrFail($codmodelo);
        $user->tipo = $request->tipo;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->name = $request->name;

        return $user->update();
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_usuarios');
    }

    public static function incluir(Request $request)
    {
        $value = User::create($request->all());
        self::limpar_cache();
        return $value;
    }


    public static function excluir($codusuario)
    {
        $value = null;
        try {
            $value = User::findOrFail($codusuario)->delete();
            self::limpar_cache();
        } catch (\Exception $e) {
        }
        return $value;
    }

    public static function vincular($codusuario, $codrepositorio){
        $usuario = User::findOrFail($codusuario);
        $repositorio = Repositorio::findOrFail($codrepositorio);
        $usuario->codrepositorio = $repositorio->codrepositorio;
        $usuario->update();
        self::limpar_cache();
        return $usuario;
    }
}
