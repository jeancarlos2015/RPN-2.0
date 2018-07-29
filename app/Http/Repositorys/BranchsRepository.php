<?php

namespace App\Http\Repositorys;


use App\Http\Models\Branchs;
use App\Http\Models\UsuarioGithub;
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
        return Branchs::create($data);
    }

    public static function excluir($codbranch)
    {
        $value = null;
        $doc = Branchs::findOrFail($codbranch);
        $value = $doc->delete();
        return $value;
    }

    public static function excluir_todas_branchs()
    {
        foreach (Branchs::all()->where('codusuario', '=', Auth::user()->codusuario) as $branch) {
            $branch->delete();
        }
    }

    public static function excluir_branch($branch)
    {
        $branchs = Auth::user()->branchs;
        dd($branchs, $branch);
        foreach ($branchs as $b) {
            if ($b->branch===$branch){
                
                self::excluir($b->codbranch);
            }

        }
    }

    public static function incluir_todas_branchs($branchs = [])
    {

        foreach ($branchs as $branch) {
            $data = [
                'branch' => $branch['name'],
                'descricao' => 'Nenhum',
                'codusuario' => Auth::user()->codusuario
            ];
            Branchs::create($data);
        }

    }

    public static function change_branch($default_branch)
    {
        $github_data = Auth::user()->github;
        $user_github = UsuarioGithub::findOrFail($github_data->codusuariogithub);
        $data = [
            'codusuario' => Auth::user()->codusuario,
            'email_github' => $github_data->email_github,
            'senha_github' => $github_data->senha_github,
            'branch_atual' => $default_branch,
            'repositorio_atual' => $github_data->repositorio_atual
        ];
        $user_github->update($data);

    }

}
