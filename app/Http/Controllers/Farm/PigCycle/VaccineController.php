<?php

namespace App\Http\Controllers\Farm\PigCycle;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Choice;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$cycle_id) {

        return Vaccine::where('pig_id',$id)->where('pig_cycle_id',$cycle_id)->get();

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
        $vaccine = new Vaccine();
        $vaccine->fill($request->all());
        $vaccine->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function show($id,$cycle_id,$vaccine_id)
    {
        return Vaccine::where('id',$vaccine_id)->where('pig_cycle_id',$cycle_id)->where('pig_id',$id)->get();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccine $vaccine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $vaccine = Vaccine::find($request->id);
        $vaccine->fill($request->all());  
        $vaccine->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$cycle_id,$vaccine_id){

        return Vaccine::destroy($vaccine_id);
    }

     /**
 * Get Data to Vue Web api for insert;
 **/
    public function getDataForWeb($id){
        $type = ($id==1)?'VACCINE':'MEDICINE';
        $data = Choice::where('parent_name',$type)->get();
        return $data;
    }
}
