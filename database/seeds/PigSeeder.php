<?php

use Illuminate\Database\Seeder;

class PigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Pig::unguard();
        \App\Models\Pig::truncate();

        factory(\App\Models\Pig::class, 50)
            ->create()
            ->each(function ($u) {
                $u->save();
            });


        \App\Models\Pig::reguard();
    }
}
