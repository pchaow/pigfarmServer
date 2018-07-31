<?php

namespace App\Http\Controllers\Farm\PigCycle;

use App\Models\PigBirth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PigService;

class BirthController extends Controller
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
        $pigBirth= new PigBirth(); 
        $pigBirth->fill($request->all());  
        $pigBirth->save();

        $service = new PigService();
        $service->changeStepCycle($request->pig_cycle_id,3);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PigBirth  $pigBirth
     * @return \Illuminate\Http\Response
     */
    public function show(PigBirth $pigBirth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PigBirth  $pigBirth
     * @return \Illuminate\Http\Response
     */
    public function edit(PigBirth $pigBirth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PigBirth  $pigBirth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $pigBirth = PigBirth::find($id);
        $pigBirth->fill($request->all());  
        $pigBirth->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PigBirth  $pigBirth
     * @return \Illuminate\Http\Response
     */
    public function destroy(PigBirth $pigBirth,$id)
    {
        return $pigBirth->destroy($id);
    }
}
