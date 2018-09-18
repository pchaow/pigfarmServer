<?php

namespace App\Http\Controllers\Farm\PigCycle;

use App\Models\PigBreeder;
use App\Models\PigCycle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PigService;

class BreederController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pigBreeder = PigBreeder::find($id);
        return $pigBreeder;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
      
        $pigBreeder = new PigBreeder(); 
        $pigBreeder->fill($request->all());  
        $pigBreeder->save(); 
        
        $service = new PigService();
        $service->changeStepCycle($request->pig_cycle_id,2);

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PigBreeder  $pigBreeder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pigBreeder = PigBreeder::find($id); 
        return $pigBreeder;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PigBreeder  $pigBreeder
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $pigBreeder = PigBreeder::find($id);
        return $pigBreeder;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PigBreeder  $pigBreeder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $pigBreeder = PigBreeder::find($id);
         $pigBreeder->fill($request->all());  
         $pigBreeder->save();  
    }

    public function gravid(Request $request){ 
        $pigBreeder = PigBreeder::find($request->gravid_id);
        $pigBreeder->gravid = $request->gravid;
        $pigBreeder->gravid_date = $request->gravid_date;
        $pigBreeder->gravid_out = $request->gravid_out;
        $pigBreeder->gravid_out_remark = $request->gravid_out_remark;
        $pigBreeder->gravid_remark = $request->gravid_remark;
        $pigBreeder->save();  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PigBreeder  $pigBreeder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PigBreeder $pigBreeder,$id)
    {    
        return $pigBreeder->destroy($id);
    }
}
