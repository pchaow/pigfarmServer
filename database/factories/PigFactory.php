<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Pig::class, function (Faker $faker) {
    return [
        'pig_id' => $faker->numerify("##-####"),
        'pig_number' => $faker->numerify("####"),
        'birth_date' => $faker->date(),
        'entry_date' => $faker->date(),
        'source' => $faker->company,
        'male_breeder_pig_id' => $faker->numerify("##-####"),
        'female_breeder_pig_id' => $faker->numerify("##-####"),
        'left_breast' => $faker->numberBetween(1, 10),
        'right_breast' => $faker->numberBetween(1, 10),
        'blood_line' => $faker->randomElement([
            "BREED_001", "BREED_002", "BREED_003", "BREED_004"
        ]),

        'status' => $faker->randomElement([
        "PIGSTATUS_001", "PIGSTATUS_002", "PIGSTATUS_003"]),
    ];
});
