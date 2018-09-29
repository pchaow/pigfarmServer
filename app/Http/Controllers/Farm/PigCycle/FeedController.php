<?php

namespace App\Http\Controllers\Farm\PigCycle;

use App\Models\PigFeed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PigService;
class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$cycle_id) {

        return PigFeed::where('pig_id',$id)->where('pig_cycle_id',$cycle_id)->get();

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
        $pigFeed= new PigFeed(); 
        $pigFeed->fill($request->all());  
        $pigFeed->save();

        $service = new PigService();
        $service->changeStepCycle($request->pig_cycle_id,4);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PigFeed  $pigFeed
     * @return \Illuminate\Http\Response
     */
    public function show($id,$cycle_id,$feed_id)
    {
        return PigFeed::where('id',$feed_id)->where('pig_cycle_id',$cycle_id)->where('pig_id',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PigFeed  $pigFeed
     * @return \Illuminate\Http\Response
     */
    public function edit(PigFeed $pigFeed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PigFeed  $pigFeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $feed = PigFeed::find($request->id);
        $feed->fill($request->all());  
        $feed->save();
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PigFeed  $pigFeed
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$cycle_id,$feed_id)
    {
        return PigFeed::destroy($feed_id);
    }
}
