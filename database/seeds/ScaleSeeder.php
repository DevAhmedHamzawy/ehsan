<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scales')->insert([
            ['type' => '0', 'measure' => '100*200'],
            ['type' => '0', 'measure' => '200*300'],
            ['type' => '0', 'measure' => '300*400'],
            ['type' => '0', 'measure' => '400*500'],
            ['type' => '0', 'measure' => '500*600'],
            ['type' => '0', 'measure' => '600*700'],
            ['type' => '0', 'measure' => '700*800'],
            ['type' => '1', 'measure' => '800*900'],
            ['type' => '1', 'measure' => '900*1000'],
            ['type' => '1', 'measure' => '1000*1100'],
            ['type' => '1', 'measure' => '1100*1200'],
            ['type' => '1', 'measure' => '1200*1300'],
            ['type' => '1', 'measure' => '1300*1400'],
            ['type' => '1', 'measure' => '1400*1500'],
            ['type' => '1', 'measure' => '1500*1600'],
            ['type' => '1', 'measure' => '1700*1800']
        ]);
    }
}
