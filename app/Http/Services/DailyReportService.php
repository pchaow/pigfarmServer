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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DailyReportService extends BaseService
{
    function generateDailyReport($currentDate){

        $query = Pig::query();
        $query->where('status','=','PIGSTATUS_001');
        $countPigId = $query->count('id');

        return [
            'report_date' => $currentDate,
            'active_breeder' => $countPigId,
        ];


    }
}