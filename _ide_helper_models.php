<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Http\Models{
/**
 * App\Http\Models\ModeloBpmn
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $caminho
 * @property int $projeto_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloBpmn whereCaminho($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloBpmn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloBpmn whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloBpmn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloBpmn whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloBpmn whereProjetoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\ModeloBpmn whereUpdatedAt($value)
 */
	class Modelo extends \Eloquent {}
}

namespace App\Http\Models{
/**
 * App\Http\Models\Operador
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Operador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Operador whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Operador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Operador whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Operador whereUpdatedAt($value)
 */
	class Operador extends \Eloquent {}
}

namespace App\Http\Models{
/**
 * App\Http\Models\Projeto
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\ModeloBpmn[] $modelos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Regra[] $regras
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Models\Tarefa[] $tarefas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereUpdatedAt($value)
 */
	class Projeto extends \Eloquent {}
}

namespace App\Http\Models{
/**
 * App\Http\Models\Recurso
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property float $custo
 * @property int $quantidade
 * @property string $tipo
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Recurso whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Recurso whereCusto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Recurso whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Recurso whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Recurso whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Recurso whereQuantidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Recurso whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Recurso whereUpdatedAt($value)
 */
	class Recurso extends \Eloquent {}
}

namespace App\Http\Models{
/**
 * App\Http\Models\Regra
 *
 * @property int $id
 * @property string $operacao
 * @property string $descricao
 * @property int $id_regra
 * @property int $projeto_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereIdRegra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereOperacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereProjetoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereUpdatedAt($value)
 */
	class Regra extends \Eloquent {}
}

namespace App\Http\Models{
/**
 * App\Http\Models\Tarefa
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property int $projeto_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereProjetoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereUpdatedAt($value)
 */
	class Tarefa extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

