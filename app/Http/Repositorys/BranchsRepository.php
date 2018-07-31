<?php

namespace App\Http\Repositorys;


use App\Http\Models\Branch;
use App\Http\Models\UsuarioGithub;
use Illuminate\Support\Facades\Auth;

class BranchsRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Branch::class);
    }

    public static function listar()
    {

        return Branch::all()
            ->where('codusuario', '=', Auth::user()->codusuario);

    }


    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar($data = [], $codbranch)
    {
        $value = Branch::findOrFail($codbranch);
        $value->update($data);
        return $value;
    }

    public static function incluir($data = [])
    {
        return Branch::create($data);
    }

    public static function excluir($codbranch)
    {
        $value = null;
        $doc = Branch::findOrFail($codbranch);
        $value = $doc->delete();
        return $value;
    }

    public static function excluir_todas_branchs()
    {
        foreach (Branch::all()->where('codusuario', '=', Auth::user()->codusuario) as $branch) {
            $branch->delete();
        }
    }

    public static function excluir_branch($branch)
    {
        $branchs = Auth::user()->branchs;
        foreach ($branchs as $b) {
            if ($b->branch === $branch) {

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
            if (!self::exists($branch['name'])) {
                Branch::create($data);
            }

        }
        $branchs_repositorio_github = collect($branchs);
        $branchs_banco = Auth::user()->branchs;
        foreach ($branchs_banco as $branch_banco){
            //consulto a branch no repositório do github
            if ($branch_banco->branch!='master'){
                $result = $branchs_repositorio_github->where('name', $branch_banco->branch);
                //se ela não existir no repositório do github será deletada do banco do sistema
                if ($result->count()==0){
                    $codbranch = $branch_banco->codbranch;
                    $instancia_branch = Branch::findOrFail($codbranch);
                    $instancia_branch->delete();
                }
            }
            
        }

    }

    public static function change_branch($branch_atual)
    {
        $github_data = Auth::user()->github;
        $user_github = UsuarioGithub::findOrFail($github_data->codusuariogithub);

        $data = [
            'usuario_github' => $user_github->usuario_github,
            'codusuario' => $user_github->codusuario,
            'email_github' => $github_data->email_github,
            'senha_github' => $github_data->senha_github,
            'branch_atual' => $branch_atual,
            'repositorio_atual' => $user_github->repositorio_atual
        ];
        $user_github->update($data);

    }

    public static function exists($branch)
    {
        $branchs = self::listar();
        foreach ($branchs as $branch_base) {
            if ($branch === $branch_base->branch) {
                return true;
            }
        }
        return false;
    }

}
