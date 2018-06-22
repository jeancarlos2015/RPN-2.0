<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Diretorio extends Model
{
    protected $primaryKey="id";
    protected $table='diretorio';
    public $timestamps=false;

protected $fillable=[
    'nome',
    'path',
    'descricao'
];
}
