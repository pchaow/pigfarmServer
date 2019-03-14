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
    public function index($id,$cycle_id) {

        $pigBreeder = PigBirth::where('pig_id',$id)->where('pig_cycle_id',$cycle_id)->get();
        return $pigBreeder;
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
    public function show($id,$cycle_id,$breder_id)
    {
        return PigBirth::where('id',$breder_id)->where('pig_cycle_id',$cycle_id)->where('pig_id',$id)->get();
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
    public function update(Request $request)
    {
        $pigBirth = PigBirth::find($request->id);
        $pigBirth->fill($request->all());  
        $pigBirth->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PigBirth  $pigBirth
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$cycle_id,$birth_id)
    {
        return PigBirth::destroy($birth_id);
    }
}
