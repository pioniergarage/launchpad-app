<?php

use Illuminate\Database\Seeder;

class OpeningTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\OpeningTime::create([
            'open_at' => \Carbon\Carbon::now(),
            'close_at' => \Carbon\Carbon::now(),
            'is_public' => true,
            'is_visible' => true,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
