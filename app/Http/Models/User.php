<?php

namespace App;

use App\Http\Models\Log;
use App\Http\Models\Organizacao;
use App\Http\Models\UsuarioGithub;
use App\Http\Util\Dado;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
 * @property-read \App\Http\Models\Organizacao $organizacoes
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

    protected $primaryKey = 'codusuario';
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'type'
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
            'type' => 'required'
        ];
    }
    
    public function organizacoes()
    {
        return $this->belongsTo(Organizacao::class, 'codusuario', 'codusuario');
    }

    public function github()
    {
        return $this->hasOne(UsuarioGithub::class, 'codusuario', 'codusuario');
    }

    public function logs(){
        return $this->belongsTo(Log::class, 'codusuario', 'codusuario');
    }

    public static function titulos(){
        return [
            'Nome',
            'Email',
            'Tipo',
            'Senha',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'nome',
            'email',
            'password',
            'type'
        ];
    }

    public static function atributos()
    {
        return [
            'nome',
            'email',
            'password',
            'type'
        ];

    }
//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto(){
        $dado = array();
        for($indice=0;$indice<5;$indice++){
            $dado[$indice] = new Dado();
        }
        return $dado;
    }
//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados(){
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 5; $indice++) {
            if ($indice < 4) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }
}
