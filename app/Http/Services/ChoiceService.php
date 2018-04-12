<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;

use App\Models\Choice;
use App\Models\User;
use Illuminate\Http\Request;

class ChoiceService extends BaseService
{

    protected $searchColumns = [
        'name' => 'like',
        'display_name' => 'like',
        'description' => 'like'
    ];

    function getQuery(Request $request)
    {
        $query = Choice::query();

        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->get('parent_id'));
        } else {
            $query->whereNull('parent_id');
        }

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query = $this->bindQuerySearchColumns($query, $keyword);
        }
        if ($request->has('with')) {
            $query = $this->bindWith($query, $request->get('with'));
        }

        return $query;
    }

    public function getChoices(Request $request)
    {
        $query = $this->getQuery($request);
        return $query->get();
    }

    public function getPaginate(Request $request)
    {
        $query = $this->getQuery($request);
        return $query->paginate();
    }

    public function getChoice(Request $request, $id)
    {
        $with = $request->get('with');
        $query = Choice::query();
        if ($request->has('with')) {
            $query->with($with);
        }


        if (is_numeric($id)) {
            $query->where('id', $id);
        } else {
            $query->where('name', $id);
        }


        $choice = $query->first();
        $choice->children;
        $choice->parent;

        return $choice;
    }

    public function store(Request $request)
    {

        $choice = new Choice();
        $choice->fill($request->all());
        $choice->name = strtoupper($choice->name);
        $choice->save();
        return $choice;
    }

    public function update(Request $request, $id)
    {
        $choice = Choice::find($id);
        if (!$choice) {
            return abort(404, "Choice not found");
        }

        $choice->fill($request->all());
        $choice->name = strtoupper($choice->name);

        $choice->save();

        return $choice;
    }

    public function destroy($id)
    {
        /** @var Choice $choice */
        $choice = Choice::find($id);
        if (!$choice) {
            return abort(404, "Choice not found");
        }
        $choice->delete();
        return [true];
    }


}