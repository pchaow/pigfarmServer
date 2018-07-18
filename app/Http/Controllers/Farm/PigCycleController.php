<?php

namespace App\Http\Controllers\Farm;

use App\Http\Controllers\Controller;
use App\Http\Requests\PigRequest;
use App\Http\Services\PigService;
use App\Models\Pig;
use App\Models\PigCycle;
use App\Models\PigBreeder;
use App\Models\Choice;
use App\Models\Vaccine;
use App\Models\PigBirth;
use App\Models\PigMilk;

use Illuminate\Http\Request;

class PigCycleController extends Controller
{

    /**
     * PigController constructor.
     * @param PigService $service
     */
    public function __construct(PigService $service)
    {
        $this->pigService = $service;
    }


    /**
     * @param PigRequest $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(PigRequest $request, $id)
    {
        return Pig::find($id)->cycles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PigRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PigRequest $request, $id)
    {
        $pig =  Pig::with(['cycles'])->where('id', $id)->first();
        $lastCycle = $pig->cycles->last();

        $pigCycle = new PigCycle();

        if ($lastCycle) {
            $pigCycle->cycle_sequence = $lastCycle->cycle_sequence + 1;
            $pigCycle->complete = false;
            $pigCycle->remark = "";
        } else {
            $pigCycle->cycle_sequence = 1;
            $pigCycle->complete = false;
            $pigCycle->remark = "";
        }

        $pig->cycles()->save($pigCycle);

        return $pigCycle;
    }

    public function storeBreeder(Request $request)
    {
        $pigBreeder = new PigBreeder();
        $pigBreeder->pig_cycle_id = $request->cy ;
        $pigBreeder->pig_id = $request->id ;
        $pigBreeder->breeder_id = $request->male ;
        $pigBreeder->breed_date = $request->dateStart ;
        $pigBreeder->delivery_date = $request->dateEnd ;
        $pigBreeder->breed_week = $request->set ;
        $pigBreeder->save();
        $pigCycle = PigCycle::where('pig_id',$request->id )
          ->where('cycle_sequence', $request->cy)
          ->update(['complete' => 2]);

    }

    public function storeBirth(Request $request)
    {
        $pigBirth = new PigBirth();
        $pigBirth->pig_id = $request->id ;
        $pigBirth->pig_sequence = $request->cy ;
        $pigBirth->date = $request->date ;
        $pigBirth->all = $request->all ;
        $pigBirth->life = $request->life ;
        $pigBirth->dead = $request->dead ;
        $pigBirth->mummy = $request->mummy ;
        $pigBirth->deformed = $request->deformed ;
        $pigBirth->avg = $request->weight ;
        $pigBirth->save();
        $pigCycle = PigCycle::where('pig_id',$request->id )
          ->where('cycle_sequence', $request->cy)
          ->update(['complete' => 3]);
    }

    public function storeMilk(Request $request)
    {
        $pigMilk = new PigMilk();
        $pigMilk->pig_id = $request->id ;
        $pigMilk->pig_sequence = $request->cy ;
        $pigMilk->date = $request->date ;
        $pigMilk->all = $request->all ;
        $pigMilk->avg = $request->weight ;
        $pigMilk->save();
    }

    public function storeVaccine(Request $request){
        $vaccine = new Vaccine();
        $vaccine->date = $request->date;
        $vaccine->name = $request->name;
        $vaccine->display = $request->display;
        $vaccine->pig_id = $request->id;
        $vaccine->cycle_sequence = $request->cy;
        $vaccine->cycle_type = $request->ct;
        $vaccine->save();
    }




    public function getChoice(){
      $parent = $_GET['parent'];
      $choice = Choice::where('parent_name', $parent)->get();
      print_r($choice->toJson());
    }

    /**
     * @param PigRequest $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function show(PigRequest $request, $id)
    {
        return $this->pigService->getPig($request, $id);
    }


    public function update(Request $request, $id)
    {
        //Save a Cycle
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->pigService->destroy($id);
    }

    public function getCycleData(){
      $pid = $_GET['pid'];
      $pcy = $_GET['pcy'];
      $pigCycle = PigCycle::where('pig_id', $pid)->where('cycle_sequence', $pcy)->get();
      print_r($pigCycle->toJson());
    }



    //breeder
    public function getBreederData(){
      $pid = $_GET['pid'];
      $pcy = $_GET['pcy'];
      $pigBreeder = PigBreeder::where('pig_id', $pid)->where('pig_cycle_id', $pcy)->get();
      print_r($pigBreeder->toJson());
    }

    //Birth
    public function getBirthData(){
      $pid = $_GET['pid'];
      $pcy = $_GET['pcy'];
      $pigBirth = PigBirth::where('pig_id', $pid)->where('pig_sequence', $pcy)->get();
      print_r($pigBirth->toJson());
    }

    //Milk
    public function getMilkData(){
      $pid = $_GET['pid'];
      $pcy = $_GET['pcy'];
      $pigMilk = PigMilk::where('pig_id', $pid)->where('pig_sequence', $pcy)->get();
      print_r($pigMilk->toJson());
    }

    //Vaccine
    public function getVaccineData(){
      $pid = $_GET['pid'];
      $pcy = $_GET['pcy'];
      $vaccine= Vaccine::where('pig_id', $pid)->where('cycle_sequence', $pcy)->get();
      print_r($vaccine->toJson());
    }

}
