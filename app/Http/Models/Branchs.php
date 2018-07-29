<?php

namespace App\Http\Models;

use App\Http\Repositorys\GitSistemaRepository;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Branchs extends Model
{
    protected $primaryKey = 'codbranch';
    protected $fillable = [
        'branch',
        'descricao',
        'codusuario'
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public static function boot(){
        Branchs::created(function ($branch) {
            try{

                GitSistemaRepository::create_branch_remote($branch->branch);

            }catch (\Exception $ex){
                
            }

        });

        Branchs::deleted(function ($branch) {
            try{
                GitSistemaRepository::delete_branch_remote($branch->branch);
            }catch (\Exception $ex){
                
            }

        });
    }
}
