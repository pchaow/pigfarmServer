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
use Illuminate\Http\Request;

class PigService extends BaseService
{

    protected $searchColumns = [
        'pig_id' => 'like',
        'pig_number' => 'like',
    ];

    function sync(Request $request, $pig)
    {
        if ($request->has('blood_line')) {
            $blood_line = $request->get('blood_line', 'none');
            $blood_line = Choice::where('name', $blood_line['name'])->first();
            $pig->bloodLine()->associate($blood_line);
        }

        return $pig;

    }

    function autoWith($query)
    {
        $query->with('bloodLine');
        $query->with('cycles');
        $query->with('cycles.breeders');

        return $query;
    }

    function getQuery(Request $request)
    {
        $query = Pig::query();

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query = $this->bindQuerySearchColumns($query, $keyword);
        }
        if ($request->has('with')) {
            $query = $this->bindWith($query, $request->get('with'));
        }

        $query->orderBy('created_at', 'desc');

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
        $query->orderBy('created_at','desc');
        return $query->paginate();
    }

    public function getPig(Request $request, $id)
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

        $query = $this->autoWith($query);
        $pig = $query->first();
        return $pig;
    }

    public function store(Request $request)
    {

        $pig = new Pig();
        $pig->fill($request->all());

        $pig = $this->sync($request,$pig);

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

        $pig = $this->sync($request,$pig);

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


}