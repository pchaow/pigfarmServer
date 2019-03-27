<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;

use App\Models\Pig;
use App\Models\PigBirth;
use App\Models\PigBreed;
use App\Models\PigMilk;
use App\Models\ReportDaily;
use App\Models\User;

class DailyReportService extends BaseService
{

    public function generateDailyReport($currentDate)
    {

        $query = Pig::query();
        $query->where('status', '=', 'PIGSTATUS_001');
        $countPigId = $query->count('id');

        $birth = PigBirth::whereDate('birth_date', $currentDate);
        $pigDeliveredRate = $this->fixDivisionZero($this->pigDeliveredRate($currentDate, 'pig_count'));

        $milk = PigMilk::whereDate('milk_date', $currentDate);
        $avgMilk = $this->fixDivisionZero($milk->avg('pig_count'));
        $ween = $this->birthCount($currentDate) / $avgMilk;

        $report_daily = new ReportDaily();
        $report_data = [
            'report_date' => $currentDate,
            'active_breeder' => $countPigId,
            'breeded_breeder' => $this->breederCount($currentDate),
            'delivery_breeder' => $this->birthCount($currentDate),
            'delivery_ratio' => ($this->breederCount($currentDate) / $this->fixDivisionZero($this->birthCount($currentDate))) * 100,
            'pig_delivered_rate' => $pigDeliveredRate,

            'pig_delivered_died_percent' => round(($this->birthDeadCount($currentDate) / $this->fixDivisionZero($pigDeliveredRate)) * 100, 2),

            'pig_delivered_success_avg' => $this->notNull($this->pigDeliveredRate($currentDate, 'life')),
            'pig_delivered_weight' => $this->notNull($birth->avg('pig_weight_avg')),

            'pig_raising_failed_perent' => $this->birthWeightPercent($currentDate),

            'ween_breeder' => round((($birth->avg('pig_weight_avg') - $this->milkCount($currentDate)) / $this->fixDivisionZero($birth->avg('pig_weight_avg'))) * 100, 2),
            'pig_ween_number' => $avgMilk,
            'pig_ween_rate' => $this->milkCount($currentDate),

            'pig_ween_weight_avg' => round($ween, 2),
            'delivered_breeder_rate' => $this->pigCircleYear(null),
            'pig_ween_breeder_rate' => $this->pigCircleYear('psy'),
            'pig_khun_breeder_rate' => 0.00,
            'breeder_replace_number' => $this->pigCreateCount($currentDate),
            'breeder_drop_percent' => round(($this->pigDeleteCount($currentDate) / $this->fixDivisionZero($countPigId)) * 100, 2),
            'breeder_replace_drop_sum' => $this->pigCreateCount($currentDate) - round(($this->pigDeleteCount($currentDate) / $countPigId) * 100, 2),

        ];
        $report_daily->fill($report_data);
        $report_daily->save();
        return $report_data;
    }

    private function pigDeliveredRate($date, $type)
    {
        $birth = PigBirth::whereDate('birth_date', $date);
        $birth = $birth->avg($type);
        return $birth;
    }

    private function breederCount($date)
    {
        $breeder = PigBreed::whereDate('breed_date', $date);
        $breed = collect($breeder->get())->unique('pig_id');
        return count($breed->values()->all());
    }

    private function birthCount($date)
    {
        $births = PigBirth::whereDate('birth_date', $date);
        $birth = collect($births->get())->unique('pig_id');
        return count($birth->values()->all());
    }

    private function birthDeadCount($date)
    {
        $birth = PigBirth::whereDate('birth_date', $date)->select(\DB::raw('dead + mummy as deads'))->pluck('deads');
        return collect($birth)->sum();
    }

    public function birthWeightPercent($date)
    {
        $birth = PigBirth::whereDate('birth_date', $date)->select(
            \DB::raw('sum(pig_count) as count'), \DB::raw('sum(pig_weight_avg) as weight'))->first();
        return round($birth->weight / $this->fixDivisionZero($birth->count), 2);
    }

    public function milkCount($date)
    {
        $milk = PigMilk::whereDate('milk_date', $date)->select('pig_count')->sum('pig_count');
        return $milk;
    }

    public function milkWeightPercent($date)
    {
        $milk = PigMilk::whereDate('milk_date', $date)->select(
            \DB::raw('sum(pig_count) as count'), \DB::raw('sum(pig_weight_avg) as weight'))->first();
        return round($milk->weight / $this->fixDivisionZero($milk->count), 2);
    }

    public function pigCreateCount($date)
    {
        $pig = Pig::whereDate('created_at', $date)->where('deleted_at', null)->count();
        return $pig;
    }

    public function pigDeleteCount($date)
    {
        $pig = \DB::table('pigs')->whereDate('deleted_at', $date)->count();
        return $pig;
    }

    public function pigCircleYear($type)
    {
        $days = 117;
        $reBreedsDays = 7;
        $outDays = 14;

        $births = PigBirth::select('pig_id');
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

    private function fixDivisionZero($number)
    {
        return ($number > 0) ? $number : 1;
    }
    private function notNull($number)
    {
        return ($number) ? $number : 0;
    }
}
