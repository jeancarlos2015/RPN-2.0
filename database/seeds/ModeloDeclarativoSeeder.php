<?php

use Illuminate\Database\Seeder;

class ModeloDeclarativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(\App\Http\Models\ModeloDeclarativo::class, 500)->create();

    }
}
