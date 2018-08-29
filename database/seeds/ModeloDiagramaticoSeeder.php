<?php

use Illuminate\Database\Seeder;

class ModeloDiagramaticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Http\Models\RepresentacaoDiagramatico::class, 50)->create();
    }
}
