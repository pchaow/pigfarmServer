<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;

use App\Models\Choice;
use App\Models\Pig;
use App\Models\User;
use App\Models\PigCycle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PigService extends BaseService
{

    protected $searchColumns = [
        'pig_id' => 'like',
        'pig_number' => 'like',
    ];

    function sync(Request $request, $pig)
    {
        if ($request->has('blood_line')) {
            $bloodLine = $request->get('blood_line', 'none');
            $blood_line = Choice::where('name', $bloodLine)->first();
            $pig->bloodLine()->associate($blood_line);
        }

        return $pig;

    }

    function autoWith($query)
    {
        $query->with('bloodLine');
        $query->with('status');
        $query->with('cycles');
        $query->with('cycles.breeders');
        $query->with('cycles.birth');
        $query->with('cycles.milk');
        $query->with('cycles.vaccine');
        $query->with('cycles.feed');
        $query->with('cycles.feedOut');

        return $query;
    }

    function getQuery(Request $request)
    {
        $query = Pig::query();

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query = $this->bindQuerySearchColumns($query, $keyword);
        }

        if ($request->has('blood_line')) {
            $bloodLine = $request->get('blood_line');
            $query->where('blood_line', $bloodLine);
        }

        if ($request->has('with')) {
            $query = $this->bindWith($query, $request->get('with'));
        }

        if ($request->has('all')) {
            $all = $request->get('all');
            if ($all == true || $all == 'true') {

            } else {
                $query->where(function ($q) {
                    $q->orWhere('status', 'PIGSTATUS_001');
                    $q->orWhereNull('status');
                });

            }
        } else {
            $query->where(function ($q) {
                $q->orWhere('status', 'PIGSTATUS_001');
                $q->orWhere('status', 'is', null);
            });
        }

        $query->orderBy('updated_at', 'desc');

        //auto with
        $query = $this->autoWith($query);

        return $query;
    }

    public function getPigs(Request $request)
    {
        $query = $this->getQuery($request);
        return $query->get();
    }

    public function getPaginate(Request $request)
    {
        $query = $this->getQuery($request);
        $query->orderBy('updated_at', 'desc');
        return $query->paginate();
    }

    public function getPig(Request $request, $id, $with = true)
    {
        $with = $request->get('with');
        $query = Pig::query();
        if ($request->has('with')) {
            $query->with($with);
        }

        if (is_numeric($id)) {
            $query->where('id', $id);
        } else {
            $query->where('pig_id', $id);
        }

        if ($with) {
            $query = $this->autoWith($query);
        }
        $pig = $query->first();
        return $pig;
    }

    public function store(Request $request)
    {

        $pig = new Pig();
        $pig->fill($request->all());

        $pig = $this->sync($request, $pig);

        $pig->save();

        return $pig;
    }

    public function update(Request $request, $id)
    {
        $pig = Pig::find($id);
        if (!$pig) {
            return abort(404, "Pig not found");
        }


        $pig->fill($request->all());

        
        if($request->status != 'PIGSTATUS_001'){
            $pig->deleted_at  = Carbon::now();
        }else{
            $pig->deleted_at = null;
        } 


        $pig = $this->sync($request, $pig);

        $pig->save();

        return $pig;
    }

    public function destroy($id)
    {
        /** @var Pig $pig */
        $pig = Pig::find($id);
        if (!$pig) {
            return abort(404, "Pig not found");
        }
        $pig->delete();
        return [true];
    }

    public function changeStepCycle($id, $step)
    {
        $pigCycle = PigCycle::find($id);
        $pigCycle->complete = $step;
        $pigCycle->save();
    }


}