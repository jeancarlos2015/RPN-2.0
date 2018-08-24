<?php

use Illuminate\Database\Seeder;

class RepositorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\http\Models\Repositorio::class,200)->create();
    }
}
