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
        \App\Models\PigBreeder::truncate();
        \App\Models\PigCycle::truncate();
        \App\Models\PigBirth::truncate();
        \App\Models\PigFeed::truncate();
        \App\Models\PigFeedOut::truncate();
        \App\Models\Vaccine::truncate();
        \App\Models\PigMilk::truncate();



        $filename = storage_path("database/all.csv");
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        $spreadsheet = $reader->load($filename);

        $sheet1 = $spreadsheet->getActiveSheet();

        $data = $sheet1->toArray();

//        print_r($data);
        foreach ($data as $row) {
            $pig = \App\Models\Pig::firstOrNew(['pig_id' => $row[0]]);
            $pigCycle = new \App\Models\PigCycle();
            $pigBreeder = new \App\Models\PigBreeder();

            $pigCycle->cycle_sequence = $row[2];

            $pigBreeder->breeder_a = $row[3];
            $pigBreeder->breeder_b = $row[4];

            $breedDate = \Carbon\Carbon::createFromFormat('m/d/Y',$row[1]);
            $deliveryDate = \Carbon\Carbon::createFromFormat('m/d/Y',$row[1]);
            $deliveryDate = $deliveryDate->addDays(116);
            $breedWeek  = $breedDate->weekOfYear;
            $pigBreeder->breed_date = new Carbon\Carbon($row[1]);
            $pigBreeder->breed_week = $breedWeek;
            $pigBreeder->delivery_date = $deliveryDate;

            $pig->pig_id = $row[0];
            $pig->status = "PIGSTATUS_001";

            $pig->save();
            $pig->cycles()->save($pigCycle);
            $pigBreeder->pig_id = $pig->id;
            $pigCycle->breeders()->save($pigBreeder);

            //echo $pig->id;
        }
    }
}
