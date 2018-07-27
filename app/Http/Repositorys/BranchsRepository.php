<?php

namespace App\Http\Repositorys;


use App\Http\Models\Branchs;
use Exception;
use Illuminate\Support\Facades\Auth;

class BranchsRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Branchs::class);
    }

    public static function listar()
    {

        return Branchs::all()
            ->where('codusuario', '=', Auth::user()->codusuario);

    }


    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar($data = [], $codbranch)
    {
        $value = Branchs::findOrFail($codbranch);
        $value->update($data);
        return $value;
    }

    public static function incluir($data = [])
    {
        $value = Branchs::create($data);
        return $value;
    }

    public static function excluir($codbranch)
    {
        $value = null;
        try {
            $doc = Branchs::findOrFail($codbranch);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

    public static function excluir_todos()
    {
        foreach (Branchs::all()->where('codusuario', '=', Auth::user()->codusuario) as $branch) {
            $branch->delete();
        }
    }

    public static function excluir_branch($branch)
    {
        $branchs = Branchs::all()->where('branch', '=', $branch);
        foreach ($branchs as $b) {
            $codbranch = $b->codbranch;
            self::excluir($codbranch);
        }
    }

}
