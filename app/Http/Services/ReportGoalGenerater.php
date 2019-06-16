<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;

use App\Models\Pig;
use App\Models\User;
use Carbon\Carbon; 
use App\Models\PigBirth;
use App\Models\PigBreed;
use App\Models\PigMilk; 
use App\Models\ReportGoal; 
use App\Models\ReportDaily; 

class ReportGoalGenerater extends BaseService
{
    private $year;

    private function storeToReport($report_data)
    {
             $report_year = new ReportGoal();
            $report_year->fill($report_data);
            $report_year->save();
            return $report_data;
       
    }

    public function generateGoalReport($type,$year,$date)
    { 
        
            echo $type.'/'.$year.'/'.$date;
            $this->year = ReportDaily::whereYear('report_date',$type);
            $this->storeToReport($this->generateReport($type,$year,$date));

     
    }

    public function generateReport($type,$year,$date)
    {
        $report_data = [
            'report_year' =>  $type,
            'report_date' => $date,
            'report_type' => $year,
            'active_breeder' => $this->year->avg('active_breeder'), //แม่พันธุ์ใช้งาน

            'breeded_breeder' => $this->year->avg('breeded_breeder'), //จำนวนแม่ผสม

            'delivery_breeder' => $this->year->avg('delivery_breeder'), //จำนวนแม่คลอด

            'delivery_ratio' => $this->year->avg('delivery_ratio')/100, //เปอร์เซ็นต์เข้าคลอด

            'pig_delivered_rate' => $this->year->avg('pig_delivered_rate'), //จำนวนลูกแรกคลอดทั้งหมดต่อครอก

            'pig_delivered_died_percent' => $this->year->avg('pig_delivered_died_percent')/100, //เปอร์เซ็นต์สูญเสียลูกสุกรแรกคลอด+ลูกกรอก(%)

            'pig_delivered_success_avg' => $this->year->avg('pig_delivered_success_avg'), //จำนวนลูกแรกคลอดมีชีวิตต่อครอก

            'pig_delivered_weight' => '0',

            'pig_raising_failed_perent' => $this->year->avg('pig_raising_failed_perent') /100, ////เปอร์เซ็นต์สูญเสียลูกสุกรก่อนหย่านม(%)

            'ween_breeder' => $this->year->avg('ween_breeder'), //จำนวนแม่หย่านม

            'pig_ween_number' => $this->year->avg('pig_ween_number'), //จำจำนวนลูกหย่านมทั้งหมด

            'pig_ween_rate' => $this->year->avg('pig_ween_rate'), //จำนวนลูกหย่านม/ครอก

            'pig_ween_weight_avg' => '0',

            'delivered_breeder_rate' => $this->year->avg('delivered_breeder_rate'), //จำจำนวนครอก/แม่/ปี

            'pig_ween_breeder_rate' => $this->year->avg('pig_ween_breeder_rate'), //จำนวนลูกลูกหย่านม/แม่/ปี (PSY)

            'pig_khun_breeder_rate' => '0.00', //จำนวนสุกรขุนต่อแม่ต่อปี(9%) (MSY)

            'breeder_replace_number' => $this->year->avg('breeder_replace_number')/100, //% สุกรสาวทดแทน
            'breeder_drop_percent' => $this->year->avg('breeder_drop_percent')/100, //% แม่สุกรคัดทิ้ง
            'breeder_replace_drop_sum' => $this->year->avg('breeder_replace_drop_sum'), //'+/- แม่ทดแทนกับแม่คัดทิ้ง

        ];
        print_r($report_data);
        return $report_data;
    }
 
}
