<?php

namespace App\Http\Controllers\Farm\PigCycle;

use App\Models\PigFeedOut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$cycle_id) {

        return PigFeedOut::where('pig_id',$id)->where('pig_cycle_id',$cycle_id)->get();

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
        $pigfeedOut= new PigFeedOut(); 
        $pigfeedOut->fill($request->all());  
        $pigfeedOut->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PigFeedOut  $pigFeedOut
     * @return \Illuminate\Http\Response
     */
    public function show($id,$cycle_id,$feedout_id)
    {
        return PigFeedOut::where('id',$feedout_id)->where('pig_cycle_id',$cycle_id)->where('pig_id',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PigFeedOut  $pigFeedOut
     * @return \Illuminate\Http\Response
     */
    public function edit(PigFeedOut $pigFeedOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PigFeedOut  $pigFeedOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pigFeedOut = PigFeedOut::find($request->id);
        $pigFeedOut->fill($request->all());  
        $pigFeedOut->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PigFeedOut  $pigFeedOut
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$cycle_id,$feedout_id)
    {
        return PigFeedOut::destroy($feedout_id);
    }
}
