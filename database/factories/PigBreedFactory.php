<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\PigBreed::class, function (Faker $faker) {
    return [
        'breed_date' => $faker->date(),
        'breeder_1_id' => $faker->numerify("Y-####"),
        'breeder_2_id' => $faker->numerify("Y-####"),
        'breeder_3_id' => $faker->numerify("Y-####"),
        'breed_status' => $faker->randomElement([
            "BREEDERSTATUS_001",
            "BREEDERSTATUS_002",
            "BREEDERSTATUS_003"
        ]),
    ];
});
