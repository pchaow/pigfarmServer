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
    public function index($id)
    {
        return PigCycle::with(['breeders','birth','feed','feedout','milk'])->where('pig_id',$id)->get();
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
            $pigCycle->complete = 1;
            $pigCycle->remark = "";
        } else {
            $pigCycle->cycle_sequence = 1;
            $pigCycle->complete = 1;
            $pigCycle->remark = "";
        }

        $pig->cycles()->save($pigCycle);

        return $pigCycle;
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
    public function show(  $id,$cycle_id)
    {
        return PigCycle::with(['breeders','birth','feed','feedout','milk'])->where('id',$cycle_id)->where('pig_id',$id)->get();

       // return $this->pigService->getPig($request, $id);
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

    //delete
    public function deleteData(){
      $type = $_GET['type'];
      $id = $_GET['id'];
     if($type == 'breeder'){
       $data = PigBreeder::where('id',$id)->delete();
     }else if($type == 'milk'){
       echo "pig";
       $data = PigMilk::where('id',$id)->delete();
     }else if($type == 'birth'){
       $data = PigBirth::where('id',$id)->delete();
     }else if($type == 'vaccine'){
       $data = Vaccine::where('id',$id)->delete();
     }


    }

}
