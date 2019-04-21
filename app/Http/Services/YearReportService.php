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

class YearReportService extends BaseService
{

    private $quater = [];
    private $year;
    private $dateReport;

    public function __construct()
    {
        $this->getYear();
    }

    public function generateYearReport()
    {

        $checkQuater = ReportQuater::where('report_year',$this->year)->where('report_quater',$this->dateReport)->first();
        if(!$checkQuater ){
        $query = Pig::query();
        $query->where('status', '=', 'PIGSTATUS_001');
        $query->whereMonth('created_at', '>', $this->quater[0]);
        $query->whereMonth('created_at', '<=', $this->quater[1]);
        $query->whereYear('created_at', $this->year);
        $countPigId = $query->count('id'); 
        $ween = $this->birthCount() / $this->fixDivisionZero($this->milkAvg());

        $report_data = [
            'report_quater' =>  $this->dateReport,
            'report_year' =>  $this->year,
            'active_breeder' =>   $countPigId,
            'breeded_breeder' =>   $this->breederCount(),
            'delivery_breeder' =>    $this->birthCount(),
            'delivery_ratio' =>   $this->deliveryRatio($this->breederCount(),$this->birthCount()),
            'pig_delivered_rate' =>  $this->pigDeliveredRate('pig_count'),

            'pig_delivered_died_percent' =>   $this->pigDeliveredDiedPercent($this->pigDeliveredRate('pig_count')),

            'pig_delivered_success_avg' =>   $this->pigDeliveredRate('life'),
            'pig_delivered_weight' =>   ($this->birthWeightAvg())?$this->birthWeightAvg():0,

            'pig_raising_failed_perent' =>   $this->birthWeightPercent(),

            'ween_breeder' =>   $this->pigWeen(),
            'pig_ween_number' =>   $this->milkAvg(),
            'pig_ween_rate' =>  $this->milkCount(),
 
            'pig_ween_weight_avg' =>  round($ween,2)  ,
            'delivered_breeder_rate' =>   $this->pigCircleYear(null),
            'pig_ween_breeder_rate' =>   $this->pigCircleYear('psy'),
            'pig_khun_breeder_rate' =>    0.00,
            'breeder_replace_number' =>   $this->pigCreateCount(),
            'breeder_drop_percent' =>   $this->breederDropPercent($countPigId),
            'breeder_replace_drop_sum' =>   $this->breederReplaceDropSum($countPigId),

        ];
        $reportQuater = new ReportQuater();
        $reportQuater->fill($report_data);
        $reportQuater->save(); 
    }
      // return $this->birthCount();
    }

    private function pigCreateCount()
    {
        $query = new Pig();
        $query = $this->queryQuater($query);
        $query = $query->where('deleted_at', null)->count();
        return $query;
    }
    public function pigDeleteCount()
    {
        $query = new Pig();
        $query = $this->queryQuater($query);
        $query = $query->where('deleted_at','!=', null)->count();
        return $query; 
    }
   
    private function breederReplaceDropSum($countPigId){

        return  $this->pigCreateCount() - round(($this->pigDeleteCount() / $countPigId) * 100, 2);

    }

    private function breederDropPercent($countPigId){

        return round(($this->pigDeleteCount() / $this->fixDivisionZero($countPigId)) * 100, 2);
    }

    private function pigDeliveredRate($type)
    {
        $query = new PigBirth();
        $query = $this->queryQuater($query);
        $query = $query->avg($type);
        return  $this->fixDivisionZero($query);
    }
     
    private function deliveryRatio($breed,$birth){ 
       return ($breed / $this->fixDivisionZero($birth)) * 100;
    }
    private function pigDeliveredDiedPercent($devery){
        $query = new PigBirth();
        $query = $this->queryQuater($query);
        $query = $query->select(\DB::raw('dead + mummy as deads'))->pluck('deads');
        $dead = collect($query)->sum();
        return round(($dead / $this->fixDivisionZero($devery)) * 100, 2);
    }
    private function birthDeadCount()
    {
        $query = PigBirth::whereDate('birth_date', $date)->select(\DB::raw('dead + mummy as deads'))->pluck('deads');
        return collect($birth)->sum();
    }

    private function breederCount(){
        $query = new PigBreed();
        $query = $this->queryQuater($query);
        $breeder = collect($query->get())->unique('pig_id');
        return count($breeder->values()->all());
    }

    private function birthCount(){
        $query = new PigBirth();
        $query = $this->queryQuater($query);
        $birth = collect($query->get())->unique('pig_id');
        return count($birth->values()->all());
    }
    private function birthWeightAvg(){
        $query = new PigBirth();
        $query = $this->queryQuater($query); 
        return $query->avg('pig_weight_avg');
    }

    private function milkAvg(){
        $query = new PigMilk();
        $query = $this->queryQuater($query); 
        return $this->fixDivisionZero($query->avg('pig_count'));
    }
    private function birthWeightPercent()
    {
        $query = new PigBirth();
        $query = $this->queryQuater($query); 
        $query = $query->select(
            \DB::raw('sum(pig_count) as count'), \DB::raw('sum(pig_weight_avg) as weight'))->first();
        return round($query->weight / $this->fixDivisionZero($query->count), 2);
    }
    private function pigWeen(){
        $milk = new PigMilk();
        $birth = new PigBirth();
        $birth = $this->queryQuater($birth);
        return round((($birth->avg('pig_weight_avg') - $this->milkCount()) / $this->fixDivisionZero($birth->avg('pig_weight_avg'))) * 100, 2);
    }

    private function milkCount(){
        $query = new PigMilk();
        $query = $this->queryQuater($query);
        $query = $query ->select('pig_count')->sum('pig_count');
        return $query;

    }


    public function pigCircleYear($type)
    {
        $days = 117;
        $reBreedsDays = 7;
        $outDays = 14;

        $births = PigBirth::select('pig_id');
        $births = $this->queryQuater($births);
        $birth = collect($births->get())->unique('pig_id');
        $birthId = collect($birth)->pluck('pig_id');
        $milkCount = PigMilk::whereIn('pig_milk.pig_id', $birthId)->sum('pig_count');
        $milk = PigMilk::whereIn('pig_milk.pig_id', $birthId)
            ->join('pig_birth', 'pig_birth.pig_id', 'pig_milk.pig_id')
            ->select(
                \DB::raw('DATEDIFF(pig_milk.milk_date,pig_birth.birth_date)  as dateCount')
            )
            ->pluck('dateCount');
        if ($type == 'psy') {
            return $milkCount;
        } else {
            return round(365 / $this->fixDivisionZero(($days + $reBreedsDays + $outDays + collect($milk)->sum())), 2);
        }

    }



    private function getYear()
    {
        $calendar = \Carbon\Carbon::now();
        $month = $calendar->month;
      
            $this->dateReport = 5;
            $this->quater[0] = '01';
            $this->quater[1] = '12';
        
        $this->year = $calendar->year;
    }

    private function fixDivisionZero($number)
    {
        return ($number > 0) ? $number : 1;
    }
    private function notNull($number)
    {
        return ($number) ? $number : 0;
    }

    private function queryQuater($query){
        $query=   $query->whereMonth('created_at', '>', $this->quater[0]);
        $query=   $query->whereMonth('created_at', '<=', $this->quater[1]);
        $query=   $query->whereYear('created_at', $this->year);
        return $query;
    }

}
