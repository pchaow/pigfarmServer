<?php

namespace App\Http\Controllers\Export;

use App\Models\ReportGoal;
use App\Models\ReportQuater;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\reportQuaterExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('exports.quater' ,[
        'quaters' => ReportQuater::all(),
            'goalQ1'=>ReportGoal::where('report_type','quater1')->first(),
            'goalQ2'=>ReportGoal::where('report_type','quater2')->first(),
            'goalQ3'=>ReportGoal::where('report_type','quater3')->first(),
            'goalQ4'=>ReportGoal::where('report_type','quater3')->first(),
        ]);
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
    public function show($id)
    {
        if($id='quater'){
            return Excel::download(new reportQuaterExport, 'quater.xlsx');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('exports.quater' ,[
            'quaters' => ReportQuater::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
