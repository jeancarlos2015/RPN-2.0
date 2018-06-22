<?php

namespace App\Repositories;

use App\Diretorio;

class DiretorioRepository extends Repository
{
    public function __construct()
    {
        $this->setModel(Diretorio::class);
    }



}