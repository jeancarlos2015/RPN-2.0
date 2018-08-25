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
        factory(\App\Http\Models\ModeloDiagramatico::class, 50)->create();
    }
}
