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

    private $choiceHeader = [
        'id' => 'int',
        'parent_name' => 'int',
        'name' => 'string',
        'display_name' => 'string',
        'description' => 'string',
        'children_fields' => 'json',
        'values' => 'json',
    ];

    public function run()
    {
        Choice::truncate();

        $filename = storage_path("database/choice.xlsx");
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($filename);

        $sheet1 = $spreadsheet->getActiveSheet();

        $i = 0;

        $header = [];

        $choicesArray = [];

        foreach ($sheet1->getRowIterator() as $row) {
            $i++;
            $cellIterator = $row->getCellIterator();

            if ($i == 1) {
                foreach ($cellIterator as $cell) {
                    $header[] = $cell;
                }
            } else {
                $j = 0;
                $newChoice = new Choice();
                foreach ($cellIterator as $cell) {
                    $attrib = $header["$j"];
                    $value = $cell->getValue();
                    switch ($this->choiceHeader["$attrib"]) {
                        case 'json' :
                            $value = json_decode($value, true);
                            if ($value == null) {
                                $value = new stdClass();
                            }
                            break;
                        default :
                            $value = $value;
                    }
                    $newChoice->$attrib = $value;
                    $j++;
                }
                $newChoice->save();
            }

        }


    }
}
