<?php

use Illuminate\Database\Seeder;
use App\Mda;

class MDAsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mda::truncate();
        
        DB::table('mdas')->insert([
            'id' => 1,
            'mda_name' => 'Ministry of Works',
        ]);

        DB::table('mdas')->insert([
            'id' => 2,
            'mda_name' => 'MPU-(POWER)',
        ]);
    }
}
