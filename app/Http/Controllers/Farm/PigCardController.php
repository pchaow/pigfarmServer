<?php

namespace App\Http\Controllers\Farm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pig; 
use App\Models\PigCycle;
use App\Models\PigBreeder;
use App\Models\Choice;
use App\Models\Vaccine;
use App\Models\PigBirth;
use App\Models\PigMilk;


class PigCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  PigCycle::with(['breeders','birth','feed','feedout','milk'])->where('pig_id',$id)->get();
       /* $pdf = \PDF::loadView('card.pig', ['pig'=>$data]); */
        return  $data;   
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
         $pig = Pig::where('id',$id)->with(['bloodLine','status','cycles'])->first();
        $cycle =  PigCycle::with(['breeders','birth','feed','feedout','milk'])->where('pig_id',$id)->first();
       
        $table=[count($cycle->breeders),count($cycle->birth),count($cycle->milk)];
        rsort($table);


        $pdf = \PDF::setOptions(['dpi' => 150]); 
        $pdf = \PDF::loadView('card.pig', ['pig'=>$pig,'cycle'=>$cycle,'count'=>4])->setPaper('A4');
        return $pdf->stream(); 
       // print_r($table);
       //return view('card.pig',['pig'=>$pig,'cycle'=>$cycle]);

       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $pig = Pig::where('id',$id)->with(['bloodLine','status','cycles'])->first();
        $cycle =  PigCycle::with(['breeders','birth','feed','feedout','milk'])->where('pig_id',$id)->first();
     /*   $pdf = \PDF::loadView('card.pig', ['pig'=>$data]);
        return $pdf->download('invoice.pdf'); */
        
        return view('card.pig', ['pig'=>$pig,'cycle'=>$cycle]);
      //  return $data;
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
