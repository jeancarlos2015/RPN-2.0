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

    public static function listar(){
        return  Cache::remember('listar_codigos_users' , 2000, function (){
            return User::get();
        });

    }
}
