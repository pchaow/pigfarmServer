<?php

use Illuminate\Database\Seeder;
use App\Models\Choice;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unitType = new Choice();
        $unitType->name = strtoupper('unittype');
        $unitType->display_name = "Unit Type";
        $unitType->description = "Type of units";

        $unitType->save();

        $pigHouse = new Choice();
        $pigHouse->name = strtoupper("unittype_stable");
        $pigHouse->display_name = "Pig Stable";
        $pigHouse->description = "โรงเลี้ยง";

        $unitType->children()->save($pigHouse);

        $pigHouse = new Choice();
        $pigHouse->name = strtoupper("unittype_delivery");
        $pigHouse->display_name = "Pig Delivered House";
        $pigHouse->description = "โรงคลอด";

        $unitType->children()->save($pigHouse);

    }
}
