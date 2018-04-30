<?php

use Illuminate\Database\Seeder;

class PigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $breedSequence = 1;

    public function run()
    {

        \App\Models\PigBreed::unguard();
        \App\Models\PigBreed::truncate();

        \App\Models\Pig::unguard();
        \App\Models\Pig::truncate();


        factory(\App\Models\Pig::class, 30)
            ->create()
            ->each(function ($u) {
                $u->save();

                $this->breedSequence = 1;
                factory(\App\Models\PigBreed::class, 3)
                    ->make()
                    ->each(function ($b) use ($u) {
                        global $i;
                        $carbon = new \Carbon\Carbon($b->breed_date);
                        $b->breed_week = $carbon->weekOfYear;
                        $b->delivery_date = $carbon->addDays(114);
                        $b->breed_sequence = $this->breedSequence;
                        $this->breedSequence += 1;
                        $u->pigBreeds()->save($b);
                    });
            });

        \App\Models\Pig::reguard();
        \App\Models\PigBreed::reguard();
    }
}
