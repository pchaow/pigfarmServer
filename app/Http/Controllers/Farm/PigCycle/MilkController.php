<?php

namespace App\Http\Controllers\Farm\PigCycle;

use App\Models\PigMilk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MilkController extends Controller
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
        $pigMilk= new PigMilk(); 
        $pigMilk->fill($request->all());  
        $pigMilk->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PigMilk  $pigMilk
     * @return \Illuminate\Http\Response
     */
    public function show(PigMilk $pigMilk)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PigMilk  $pigMilk
     * @return \Illuminate\Http\Response
     */
    public function edit(PigMilk $pigMilk)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PigMilk  $pigMilk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pigMilk = PigMilk::find($request->id);
        $pigMilk->fill($request->all());  
        $pigMilk->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PigMilk  $pigMilk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$cycle_id,$milk_id)
    {
        return PigMilk::destroy($milk_id);
    }
}
