<?php

use Illuminate\Database\Seeder;

class RegraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\http\Models\Regra::class, 100)->create();
    }
}
