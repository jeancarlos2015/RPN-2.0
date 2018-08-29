<?php

namespace App\Http\Fachadas;

use App\Http\Repositorys\BranchsRepository;
use App\Http\Repositorys\GitSistemaRepository;
use Illuminate\Support\Facades\Auth;

class FachadaRepositorio
{

    public static function selecionar_repositorio($dado)
    {
        if (Auth::user()->email==='jeancarlospenas25@gmail.com'){
            $repositorio_atual = $dado['repositorio_atual'];
            $default_branch = $dado['default_branch'];
            GitSistemaRepository::selecionar_repositorio($default_branch, $repositorio_atual);
        }else{
            $repositorio_atual = $dado['repositorio_atual'];
            $default_branch = $dado['default_branch'];
            GitSistemaRepository::selecionar_repositorio($default_branch, $repositorio_atual);
            $branch_rascunho = [
                'branch' => 'rascunho',
                'descricao' => 'rascunho',
                'cod_usuario' => Auth::user()->cod_usuario
            ];
            $branch_original = [
                'branch' => 'original',
                'descricao' => 'original',
                'cod_usuario' => Auth::user()->cod_usuario
            ];
            BranchsRepository::incluir($branch_original);
            sleep(2);
            BranchsRepository::incluir($branch_rascunho);
            GitSistemaRepository::merge_checkout('checkout', 'rascunho');
        }

    }
}
