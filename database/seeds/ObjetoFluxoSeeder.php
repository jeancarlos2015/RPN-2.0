<?php

use Illuminate\Database\Seeder;

class ObjetoFluxoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\http\Models\ObjetoFluxo::class,100)->create();
    }
}
