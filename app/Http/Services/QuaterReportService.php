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
use App\Models\ReportQuater; 
use App\Models\ReportDaily;
class QuaterReportService extends BaseService
{

    private $quater; 

    private function storeToReport($report_data)
    {
             $report_year = new ReportQuater();
            $report_year->fill($report_data);
            $report_year->save();
            return $report_data;
       
    }
    
    public function generateQuaterReport($currentYear,$currentQuater)
    {
        echo 'Year: '.$currentYear.' /Quater: '.$currentQuater;
        $checkYear = ReportQuater::where('report_year', $currentYear)->where('report_quater', $currentQuater)->first();
        if (!$checkYear) {
            if($currentQuater == 1){
                $this->quater = ReportDaily::whereYear('report_date',$currentYear)
                ->whereMonth('report_date','>=','01')
                ->whereMonth('report_date','<=','03');
            }else  if($currentQuater == 2){
                $this->quater = ReportDaily::whereYear('report_date',$currentYear)
                ->whereMonth('report_date','>=','04')
                ->whereMonth('report_date','<=','06');
            }else  if($currentQuater == 3){
                $this->quater = ReportDaily::whereYear('report_date',$currentYear)
                ->whereMonth('report_date','>=','07')
                ->whereMonth('report_date','<=','09');
            }else{
                $this->quater = ReportDaily::whereYear('report_date',$currentYear)
                ->whereMonth('report_date','>=','10')
                ->whereMonth('report_date','<=','12');
            }
             
          if($this->quater->count() > 0 ){ 
                $this->storeToReport($this->generateReport($currentYear,$currentQuater));
            }else{
                echo  'ไม่มีข้อมูลปีนี้ (No data for this year)'; 
            } 
             
        }else{
            echo 'บันทึกข้อมูลปีนี้แล้ว (This year is  already recorded)';
        } 
    }

    

    public function generateReport($currentYear,$currentQuater)
    {
        $report_data = [
            'report_year' => $currentYear,
            'report_quater' => $currentQuater,
            'active_breeder' => $this->quater->avg('active_breeder'), //แม่พันธุ์ใช้งาน

            'breeded_breeder' => $this->quater->avg('breeded_breeder'), //จำนวนแม่ผสม

            'delivery_breeder' => $this->quater->avg('delivery_breeder'), //จำนวนแม่คลอด

            'delivery_ratio' => $this->quater->avg('delivery_ratio')/100, //เปอร์เซ็นต์เข้าคลอด

            'pig_delivered_rate' => $this->quater->avg('pig_delivered_rate'), //จำนวนลูกแรกคลอดทั้งหมดต่อครอก

            'pig_delivered_died_percent' => $this->quater->avg('pig_delivered_died_percent')/100, //เปอร์เซ็นต์สูญเสียลูกสุกรแรกคลอด+ลูกกรอก(%)

            'pig_delivered_success_avg' => $this->quater->avg('pig_delivered_success_avg'), //จำนวนลูกแรกคลอดมีชีวิตต่อครอก

            'pig_delivered_weight' => '0',

            'pig_raising_failed_perent' => $this->quater->avg('pig_raising_failed_perent')/100, ////เปอร์เซ็นต์สูญเสียลูกสุกรก่อนหย่านม(%)

            'ween_breeder' => $this->quater->avg('ween_breeder'), //จำนวนแม่หย่านม

            'pig_ween_number' => $this->quater->avg('pig_ween_number'), //จำจำนวนลูกหย่านมทั้งหมด

            'pig_ween_rate' => $this->quater->avg('pig_ween_rate'), //จำนวนลูกหย่านม/ครอก

            'pig_ween_weight_avg' => '0',

            'delivered_breeder_rate' => $this->quater->avg('delivered_breeder_rate'), //จำจำนวนครอก/แม่/ปี

            'pig_ween_breeder_rate' => $this->quater->avg('pig_ween_breeder_rate'), //จำนวนลูกลูกหย่านม/แม่/ปี (PSY)

            'pig_khun_breeder_rate' => '0.00', //จำนวนสุกรขุนต่อแม่ต่อปี(9%) (MSY)

            'breeder_replace_number' => $this->quater->avg('breeder_replace_number')/100, //% สุกรสาวทดแทน
            'breeder_drop_percent' => $this->quater->avg('breeder_drop_percent')/100, //% แม่สุกรคัดทิ้ง
            'breeder_replace_drop_sum' => $this->quater->avg('breeder_replace_drop_sum'), //'+/- แม่ทดแทนกับแม่คัดทิ้ง

        ];
        print_r($report_data);
        return $report_data;
    }
 


}
