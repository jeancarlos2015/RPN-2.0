<?php

namespace App;

use App\Http\Models\Branch;
use App\Http\Models\Log;
use App\Http\Models\Repositorio;
use App\Http\Models\UsuarioGithub;
use App\Http\Util\Dado;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

/**
 * App\User
 *
 * @property int $codusuario
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Http\Models\Repositorio $repositorios
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
//    protected $connection = 'pgsql';
    protected $primaryKey = 'cod_usuario';
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'tipo', 'cod_repositorio'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function validacao()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => 'required|max:50',
            'tipo' => 'required'
        ];
    }

    public function repositorios()
    {
        return $this->belongsTo(Repositorio::class, 'cod_usuario', 'cod_usuario');
    }


    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'cod_repositorio', 'cod_repositorio');
    }

    public function github()
    {
        return $this->hasOne(UsuarioGithub::class, 'cod_usuario', 'cod_usuario');
    }

    public function usuario_github()
    {
        return Crypt::decrypt($this->github->usuario_github);
    }

    public function usuario_senha()
    {
        return Crypt::decrypt($this->github->senha_github);
    }

    public function branchs()
    {
        return $this->hasMany(Branch::class, 'cod_usuario', 'cod_usuario');
    }

    public function logs()
    {
        return $this->belongsTo(Log::class, 'cod_usuario', 'cod_usuario');
    }

    public static function titulos()
    {
        return [
//            'Nome',
//            'Email',
//            'Tipo',
//            'Senha',
            'Usuário',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'nome',
            'email',
            'password',
            'tipo'
        ];
    }

    public static function atributos()
    {
        return [
            'nome',
            'email',
            'password',
            'tipo'
        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 5; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 4; $indice++) {
            if ($indice < 2) {

                $dados[$indice]->titulo = $titulos[$indice];
            }
            $dados[$indice]->campo = $campos[$indice];
            $dados[$indice]->atributo = $atributos[$indice];

        }
        return $dados;
    }
}
