<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;

use App\Models\ReportDaily; 

class DailyReportService extends BaseService
{
    private $pigs;
    private $breed;
    private $birth;
    private $feedout;
    private $milk;
    private $pigsDelete;

    private function storeToReport($report_data, $currentDate)
    {

        $checkDaily = ReportDaily::where('report_date', $currentDate)->first();
        if (!$checkDaily) {
            $report_daily = new ReportDaily();
            $report_daily->fill($report_data);
            $report_daily->save();
            return $report_data;
        }
    }

    public function generateDailyReport($currentDate)
    {
        $checkDaily = ReportDaily::where('report_date', $currentDate)->first();
        if (!$checkDaily) {
            $this->pigs = \DB::table('pigs')->where('status', '=', 'PIGSTATUS_001');
            $this->pigsDelete = \DB::table('pigs')->where('deleted_at', '!=', null);
            $this->breed = \DB::table('pig_breeders')->whereDate('breed_date', '=', $currentDate);
            $this->birth = \DB::table('pig_birth')->whereDate('birth_date', '=', $currentDate);
            $this->feedout = \DB::table('pig_feed_out')->whereDate('feed_date', '=', $currentDate);
            $this->milk = \DB::table('pig_milk')->whereDate('milk_date', '=', $currentDate);

            $report_data = $this->generateReport($currentDate);
            return $this->storeToReport($report_data, $currentDate);
        }

    }

    public function generateReport($currentDate)
    {
        $report_data = [
            'report_date' => $currentDate,
            'active_breeder' => $this->breederActive(), //แม่พันธุ์ใช้งาน
            'breeded_breeder' => $this->breederBreed(), //จำนวนแม่ผสม
            'delivery_breeder' => $this->breederBirth(), //จำนวนแม่คลอด
            'delivery_ratio' => $this->birthPercent(), //เปอร์เซ็นต์เข้าคลอด
            'pig_delivered_rate' => $this->birthTotal(), //จำนวนลูกแรกคลอดทั้งหมดต่อครอก
            'pig_delivered_died_percent' => $this->birthDeadPercent(), //เปอร์เซ็นต์สูญเสียลูกสุกรแรกคลอด+ลูกกรอก(%)
            'pig_delivered_success_avg' => $this->birthLifeTotal(), //จำนวนลูกแรกคลอดมีชีวิตต่อครอก

            'pig_delivered_weight' => '0',

            'pig_raising_failed_perent' => $this->birthDeadMilkPercent(), ////เปอร์เซ็นต์สูญเสียลูกสุกรก่อนหย่านม(%)
            'ween_breeder' => $this->milkTotal(), //จำนวนแม่หย่านม
            'pig_ween_number' => $this->milkTotalAll(), //จำจำนวนลูกหย่านมทั้งหมด
            'pig_ween_rate' => $this->milkTotalBrood(), //จำนวนลูกหย่านม/ครอก

            'pig_ween_weight_avg' => '0',

            'delivered_breeder_rate' => $this->pigsYear(), //จำจำนวนครอก/แม่/ปี
            'pig_ween_breeder_rate' => $this->psy(), //จำนวนลูกลูกหย่านม/แม่/ปี (PSY)
            'pig_khun_breeder_rate' => '0.00', //จำนวนสุกรขุนต่อแม่ต่อปี(9%) (MSY)

            'breeder_replace_number' => $this->pigsReplace(), //% สุกรสาวทดแทน
            'breeder_drop_percent' => $this->pigsDeletePercent(), //% แม่สุกรคัดทิ้ง
            'breeder_replace_drop_sum' => $this->sumPigsDelete(), //'+/- แม่ทดแทนกับแม่คัดทิ้ง

        ];
        print_r($report_data);
        return $report_data;
    }

    /** แม่พันธุ์ใช้งาน
     * นับจากแม่พันธ์ุทั้งหมดที่สถานะพร้อมใช่งาน
     * **/
    private function breederActive()
    {
        return $this->pigs->count();
    }

    /** จำนวนแม่ผสม
     * นับจากแม่พันธุ์ที่ใช้ผสม
     * **/
    private function breederBreed()
    {
        $pigs = $this->breed->get();
        $breed = collect($pigs)->unique('pig_id');
        return count($breed->values()->all());
    }

    /** จำนวนแม่คลอด
     * นำจากหมูที่คลอด
     * **/
    private function breederBirth()
    {
        $pigs = $this->birth->get();
        $birth = collect($pigs)->unique('pig_id');
        return count($birth->values()->all());
    }

    /** เปอร์เซ็นต์เข้าคลอด
     * จำนวนหมูที่คลอด / จำนวนหมูทั้งหมด x 100
     * **/
    private function birthPercent()
    {
        $birth = $this->breederBirth();
        $pigs = $this->breederActive();
        $result = ($birth / $pigs) * 100;
        return round($result, 2);
    }

    /**จำนวนลูกแรกคลอดทั้งหมดต่อครอก
     * นับจากหมูที่เข้าคอก
     * **/
    private function birthTotal()
    {
        $result = $this->birth->count('pig_count');
        return round($result, 2);
    }

    /**เปอร์เซ็นต์สูญเสียลูกสุกรแรกคลอด+ลูกกรอก(%)
     *
     * [(มัมมี่ + ตาย) / จำนวนที่เข้าคอก] * 100
     * **/
    private function birthDeadPercent()
    {
        try {
            $birth = $this->breederBirth();
            $dead = $this->birth->avg('dead');
            $mummy = $this->birth->avg('mummy');
            $lose = ($mummy + $dead);
            $result = ($lose / $birth) * 100;
            return round($result, 2);
        } catch (\Throwable $th) {
            return 0;
        }

    }

    /**จำนวนลูกแรกคลอดมีชีวิตต่อครอก
     * นับจากหมูที่มีชีวิตตอนคลอด
     * **/
    private function birthLifeTotal()
    {
        try {
            $birth = $this->breederBirth();
            $life = $this->birth->avg('life');
            $result = ($life / $birth) * 100;
            return round($result, 2);
        } catch (\Throwable $th) {
            return 0;
        }

    }

    /**เปอร์เซ็นต์สูญเสียลูกสุกรก่อนหย่านม(%)
     * (ค่าเฉลี่ยหมูที่ตายตอนก่อนอย่านม / หมูทั้งหมดที่เกิด ) x 100
     * **/
    private function birthDeadMilkPercent()
    {try {
        $feedout = $this->feedout->avg('pig_count');
        $birth = $this->breederBirth();
        $result = ($feedout / $birth) * 100;
        return round($feedout, 2);
    } catch (\Throwable $th) {
        return 0;
    }

    }

    /**จำนวนแม่หย่านม
     * ค่าเฉลี่ยจำนวนแม่หย่านม
     * **/
    private function milkTotal()
    {
        $milk = $this->milk->avg('pig_count');
        return round($milk, 2);
    }

    /**จำนวนลูกหย่านมทั้งหมด
     * นับจากจำนวนแม่หย่านม
     ***/
    private function milkTotalAll()
    {
        $milk = $this->milk->count('pig_count');
        return round($milk, 2);
    }

    /**จำนวนลูกหย่านม/ครอก
     * จำนวนคอก / จำนวนลูกที่หย่านม
     * **/
    private function milkTotalBrood()
    {
        try {
            $milk = $this->milk->avg('pig_count');
            $birth = $this->breederBirth();
            $result = $birth / $milk;
            return round($result, 2);
        } catch (\Throwable $th) {
            return 0;
        }

    }

    /***จำนวนลูกลูกหย่านม/แม่/ปี (PSY)
     *
     * นับจำนวนจากไอดีหมูที่มีการหย่านม แล้ว sum จาก pig_count
     */
    private function psy()
    {

        $births = $this->birth->select('pig_id');
        $birth = collect($births->get())->unique('pig_id');
        $birthId = collect($birth)->pluck('pig_id');
        $milkCount = $this->milk->whereIn('pig_milk.pig_id', $birthId)->sum('pig_count');

        return $milkCount;

    }

    /***จำจำนวนครอก/แม่/ปี
     * 365 / (117 + 7 + 14 + sum(หย่านม) )
     */
    private function pigsYear()
    {
        $days = 117;
        $reBreedsDays = 7;
        $outDays = 14;

        $births = \DB::table('pig_birth')->select('pig_id');
        $birth = collect($births->get())->unique('pig_id');
        $birthId = collect($birth)->pluck('pig_id');
        $milk = \DB::table('pig_milk')->whereIn('pig_milk.pig_id', $birthId)
            ->join('pig_birth', 'pig_birth.pig_id', 'pig_milk.pig_id')
            ->select(
                \DB::raw('DATEDIFF(pig_milk.milk_date,pig_birth.birth_date)  as dateCount')
            )
            ->pluck('dateCount');

        return round(365 / ($days + $reBreedsDays + $outDays + collect($milk)->sum()), 2);

    }

/*** % สุกรสาวทดแทน
 * หมูที่ไม่ได้ถูกคัดทิ้ง
 */
    public function pigsReplace()
    {
        $pig = $this->pigs->where('deleted_at', null)->count();
        return $pig;
    }

/*** % แม่สุกรคัดทิ้ง
 * หมูที่ถูกคัดทิ้ง
 */
    public function pigsDeletePercent()
    {
        $pigsDelete = $this->pigsDelete->count('id');
        $pigs = $this->pigs->count('id');
        $result = ($pigsDelete / $pigs) * 100;
        return round($result, 2);
    }

/**'+/- แม่ทดแทนกับแม่คัดทิ้ง
 * หมูที่ถูกคัดทิ้ง / หมูที่ทดแทน
 */
    public function sumPigsDelete()
    {
        $replace = $this->pigsReplace();
        $delete = $this->pigsDeletePercent();
        $result = $delete / $replace;
        return round($result, 2);
    }
}
