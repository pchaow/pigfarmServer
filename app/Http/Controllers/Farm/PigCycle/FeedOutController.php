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
    public function show(PigFeedOut $pigFeedOut)
    {
        //
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
    public function update(Request $request,$id)
    {
        $pigFeedOut = PigFeedOut::find($id);
        $pigFeedOut->fill($request->all());  
        $pigFeedOut->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PigFeedOut  $pigFeedOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(PigFeedOut $pigFeedOut,$id)
    {
        return $pigFeedOut->destroy($id);
    }
}
