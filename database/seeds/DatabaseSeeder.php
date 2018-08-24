<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $this->call(\App\http\Models\Repositorio::class);
        $this->call(\App\http\Models\Projeto::class);
         $this->call(ModeloDiagramaticoSeeder::class);
         $this->call(ModeloDeclarativoSeeder::class);
         $this->call(\App\http\Models\ObjetoFluxo::class);
         $this->call(\App\http\Models\Regra::class);

         \Illuminate\Database\Eloquent\Model::reguard();
    }
}
