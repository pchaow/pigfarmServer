<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;

use App\Models\Choice; 
use Illuminate\Http\Request; 
use App\Models\Pig;
use App\Models\User;
use Carbon\Carbon; 
use App\Models\PigBirth;
use App\Models\PigBreed;
use App\Models\PigMilk; 
use App\Models\ReportQuater; 
use App\Models\ReportGoal;
class ShowReportService extends BaseService
{
    
    public function getQuaterByYear($year){
        $dataDefault = array("report_quater"=> 4,
        "report_year"=> "2019",
        "active_breeder"=> 0,
        "breeded_breeder"=> 0,
        "delivery_breeder"=> 0,
        "delivery_ratio"=> 0,
        "pig_delivered_rate"=> 1,
        "pig_delivered_died_percent"=> 0,
        "pig_delivered_success_avg"=> 1,
        "pig_delivered_weight"=> 0,
        "pig_raising_failed_perent"=> 0,
        "ween_breeder"=> 0,
        "pig_ween_number"=> 1,
        "pig_ween_rate"=> 0,
        "pig_ween_weight_avg"=> 0,
        "delivered_breeder_rate"=> 2.64,
        "pig_ween_breeder_rate"=> 0,
        "pig_khun_breeder_rate"=> 0,
        "breeder_replace_number"=> 0,
        "breeder_drop_percent"=> 0,
        "breeder_replace_drop_sum"=> 0 );
        
        $goal1 = ReportGoal::whereYear('report_date',$year)->where('report_type','quater1')->first();
        $goal2 = ReportGoal::whereYear('report_date',$year)->where('report_type','quater2')->first();
        $goal3 = ReportGoal::whereYear('report_date',$year)->where('report_type','quater3')->first();
        $goal4 = ReportGoal::whereYear('report_date',$year)->where('report_type','quater4')->first(); 
        $goalYear = ReportGoal::whereYear('report_date',$year)->where('report_type','year')->first();

        $quater1 = ReportQuater::where('report_year',$year)->where('report_quater',1)->first();
        $quater2 = ReportQuater::where('report_year',$year)->where('report_quater',2)->first();
        $quater3 = ReportQuater::where('report_year',$year)->where('report_quater',3)->first();
        $quater4 = ReportQuater::where('report_year',$year)->where('report_quater',4)->first();
        $year = ReportQuater::where('report_year',$year)->where('report_quater',5)->first();
        return array(
            'goal1'=>($goal1)?$goal1:$dataDefault ,
            'goal2'=>($goal2)?$goal2:$dataDefault  ,
            'goal3'=>($goal3)?$goal3:$dataDefault  ,
            'goal4'=>($goal4)?$goal4:$dataDefault  ,
            'goalYear'=>($goalYear)?$goalYear:$dataDefault  ,
            'quater1'=>($quater1)?$quater1:$dataDefault  ,
            'quater2'=>($quater2)?$quater2:$dataDefault  ,
            'quater3'=>($quater3)?$quater3:$dataDefault  ,
            'quater4'=>($quater4)?$quater4:$dataDefault  ,
            'year'=>($year)?$year:$dataDefault 
        );
    }

    public function getYear(){
        $years = ReportQuater::select('report_year')->pluck('report_year')->toArray();
        $year =  array_unique($years);
        return array_values($year);
    }
    public function getGoalYear(){
        $years = ReportGoal::select('report_year')->pluck('report_year')->toArray();
        $year =  array_unique($years);
        return array_values($year);
    }

}