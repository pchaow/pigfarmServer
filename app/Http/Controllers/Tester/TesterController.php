<?php

namespace App\Http\Controllers\Tester;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pig; 
use App\Models\User; 
use App\Models\PigBreed; 
use App\Models\PigBirth; 
use App\Models\PigMilk; 
use App\Models\PigFeedOut;
use App\Models\PigCycle; 
use App\Models\ReportDaily;
use Illuminate\Support\Facades\Hash;
class TesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($currentDate)
    {
        $query = Pig::query();
        $query->where('status', '=', 'PIGSTATUS_001');
        $countPigId = $query->count('id');
        $birth = PigBirth::whereDate('birth_date',$currentDate);
        $milk = PigMilk::whereDate('milk_date',$currentDate);

        $report_daily = new ReportDaily();
        $report_data = [
            'report_date' => $currentDate,
            'active_breeder' => $countPigId,
            'breeded_breeder' =>$this->breederCount($currentDate),
            'delivery_breeder' =>$this->birthCount($currentDate),
            'delivery_ratio' =>($this->breederCount($currentDate)/$this->birthCount($currentDate))*100,
            'pig_delivered_rate'=> $this->pigDeliveredRate($currentDate,'pig_count'),

            'pig_delivered_died_percent'=>round(($this->birthDeadCount($currentDate)/ $this->pigDeliveredRate($currentDate,'pig_count'))*100,2),

            'pig_delivered_success_avg' =>$this->pigDeliveredRate($currentDate,'life'),
            'pig_delivered_weight'=>$birth->avg('pig_weight_avg'),

            'pig_raising_failed_perent'=>$this->birthWeightPercent($currentDate),

            'ween_breeder'=> round( (($birth->avg('pig_weight_avg') - $this->milkCount($currentDate)) / $birth->avg('pig_weight_avg'))*100 ,2),
            'pig_ween_number'=>$milk->avg('pig_count'), 
            'pig_ween_rate'=>  $this->milkCount($currentDate),
            
            'pig_ween_weight_avg'=> round($this->birthCount($currentDate)/ $milk->avg('pig_count') ,2),
            'delivered_breeder_rate'=>$this->pigCircleYear(null),
            'pig_ween_breeder_rate'=>$this->pigCircleYear('psy'),
            'pig_khun_breeder_rate'=> 0.00,
             'breeder_replace_number'=>$this->pigCreateCount($currentDate),
            'breeder_drop_percent'=>round( ( $this->pigDeleteCount($currentDate)/$countPigId) *100 ,2),
            'breeder_replace_drop_sum'=> $this->pigCreateCount($currentDate) - round( ( $this->pigDeleteCount($currentDate)/$countPigId) *100 ,2)

        ]; 
        $report_daily->fill($report_data);
        $report_daily->save();
        return  $report_data;
 
    }


    private function pigDeliveredRate($date,$type){
        $birth = PigBirth::whereDate('birth_date',$date);
        $birth = $birth->avg($type);
        return $birth;
    }

    private function breederCount($date){
        $breeder = PigBreed::whereDate('breed_date',$date);
        $breed= collect($breeder->get())->unique('pig_id');
        return count($breed->values()->all()); 
    }

    private function birthCount($date){
        $births = PigBirth::whereDate('birth_date',$date);
        $birth= collect($births->get())->unique('pig_id');
        return count($birth->values()->all()); 
    }

    private function birthDeadCount($date){
        $birth = PigBirth::whereDate('birth_date',$date)->select(\DB::raw('dead + mummy as deads'))->pluck('deads');
        return collect($birth )->sum();
    }

    public function birthWeightPercent($date)
    {
        $birth = PigBirth::whereDate('birth_date',$date)->select(
            \DB::raw('sum(pig_count) as count'),\DB::raw('sum(pig_weight_avg) as weight'))->first();
        return round($birth->weight/$birth->count,2);
    }

    public function milkCount($date)
    {
       $milk = PigMilk::whereDate('milk_date',$date)->select('pig_count')->sum('pig_count');
       return $milk;
    }

    public function milkWeightPercent($date)
    {
        $milk = PigMilk::whereDate('milk_date',$date)->select(
            \DB::raw('sum(pig_count) as count'),\DB::raw('sum(pig_weight_avg) as weight'))->first();
        return round($milk->weight/$milk->count,2);
    }

    public function pigCreateCount($date)
    {
       $pig =   Pig::whereDate('created_at',$date)->where('deleted_at',null)->count();
       return $pig;
    } 

    public function pigDeleteCount($date)
    {
        $pig =   \DB::table('pigs')->whereDate('deleted_at',$date)->count();
        return $pig;
    }

    public function pigCircleYear($type)
    {
        $days = 117;
        $reBreedsDays = 7;
        $outDays = 14;

        $births = PigBirth::select('pig_id');
        $birth= collect($births->get())->unique('pig_id');
        $birthId =   collect($birth)->pluck('pig_id');
        $milkCount = PigMilk::whereIn('pig_milk.pig_id',$birthId)->sum('pig_count');
        $milk = PigMilk::whereIn('pig_milk.pig_id',$birthId)
                ->join('pig_birth','pig_birth.pig_id','pig_milk.pig_id')
                ->select(
                   \DB::raw('DATEDIFF(pig_milk.milk_date,pig_birth.birth_date)  as dateCount')
                    )
                ->pluck('dateCount');
        if($type == 'psy'){
            return $milkCount;
        }else{
            return round( 365/ ($days + $reBreedsDays + $outDays + collect($milk)->sum()),2);
        }
       
    }

    public function destroy($date)
    {
        $pig =   \DB::table('pigs')->whereDate('deleted_at',$date)->count();
        return $pig;
    }
    
}
