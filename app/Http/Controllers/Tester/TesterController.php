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
use App\Http\Services\QuaterReportService;
class TesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quater = new QuaterReportService();
        return $quater->generateQuaterReport();
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
    public function show()
    {
        
    }
    
}
