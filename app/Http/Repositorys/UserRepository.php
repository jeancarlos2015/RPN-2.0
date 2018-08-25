<?php

namespace App\Http\Repositorys;


use App\Http\Models\Repositorio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(User::class);
    }

    public static function get_codigos(){
        return  Cache::remember('listar_codigos_users' , 2000, function (){
            return DB::table('users')
                ->select('codusuario')
                ->get();
        });

    }
}
