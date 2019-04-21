<?php

namespace App\Exports;

use App\Models\ReportGoal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\ReportQuater;
class reportQuaterExport implements FromView
{
    

    public function view(): View
    {
        return view('exports.quater' ,[
            'quaters' => ReportQuater::all(),
            'goalQ1'=>ReportGoal::where('report_type','quater1')->first(),
            'goalQ2'=>ReportGoal::where('report_type','quater2')->first(),
            'goalQ3'=>ReportGoal::where('report_type','quater3')->first(),
            'goalQ4'=>ReportGoal::where('report_type','quater3')->first(),
        ]);
    }
}
