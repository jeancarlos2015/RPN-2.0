<?php

namespace App\Http\Models;

use App\Http\Repositorys\GitSistemaRepository;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $primaryKey = 'cod_branch';
    protected $table = 'branchs';
    protected $fillable = [
        'branch',
        'descricao',
        'cod_usuario'
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'cod_usuario', 'cod_usuario');
    }

    public static function boot(){
        Branch::created(function ($branch) {
            try{

                GitSistemaRepository::create_branch_remote($branch->branch);

            }catch (\Exception $ex){
                
            }

        });

        Branch::deleted(function ($branch) {
            try{
                GitSistemaRepository::delete_branch_remote($branch->branch);
            }catch (\Exception $ex){
                
            }

        });
    }
}
