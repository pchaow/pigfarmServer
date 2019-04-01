<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\ReportQuater;
class reportQuaterExport implements FromView
{
    

    public function view(): View
    {
        return view('exports.quater', [
            'quaters' => ReportQuater::all()
        ]);
    }
}
