<?php

namespace App\Http\Controllers\Farm;

use App\Http\Controllers\Controller;
use App\Http\Requests\PigRequest;
use App\Http\Services\PigService;
use App\Models\Pig;
use App\Models\PigCycle;

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
    public function index(PigRequest $request,$id)
    {
       return Pig::find($id)->cycles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PigRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PigRequest $request,$id)
    {
        $pig =  Pig::with(['cycles'])->where('id',$id)->first();
        $lastCycle = $pig->cycles->last();

        $pigCycle = new PigCycle();

        if($lastCycle){
            $pigCycle->cycle_sequence = $lastCycle->cycle_sequence + 1;
            $pigCycle->complete = false;
            $pigCycle->remark = "";
        }else {
            $pigCycle->cycle_sequence = 1;
            $pigCycle->complete = false;
            $pigCycle->remark = "";
        }

        $pig->cycles()->save($pigCycle);

        return $pigCycle;

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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PigRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PigRequest $request, $id)
    {
        return $this->pigService->update($request, $id);
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
}
