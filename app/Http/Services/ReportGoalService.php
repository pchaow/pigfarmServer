<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;

use App\Models\ReportGoal;
use App\Models\User;
use Illuminate\Http\Request;

class ReportGoalService extends BaseService
{

    protected $searchColumns = [
        'name' => 'like',
        'display_name' => 'like',
        'description' => 'like'
    ];

    function getQuery(Request $request)
    {
        $query = ReportGoal::query();

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query = $this->bindQuerySearchColumns($query, $keyword);
        }
        return $query;
    }


    public function getReportGoals(Request $request)
    {
        $query = $this->getQuery($request);
        return $query->get();
    }

    public function getPaginate(Request $request)
    {
        $query = $this->getQuery($request);
        return $query->paginate();
    }

    /**
     * @param $id
     * @return ReportGoal|mixed
     */
    public function getReportGoal($id)
    {
        $reportGoal = ReportGoal::find($id);
        return $reportGoal;
    }

    public function store(Request $request)
    {
        $reportGoal = new ReportGoal();
        $reportGoal->fill($request->all());

        $reportGoal->save();
        return $reportGoal;
    }

    public function update(Request $request, $id)
    {

        $reportGoal = $this->getReportGoal($id);
        $reportGoal->fill($request->all());
        $reportGoal->save();
        return $reportGoal;
    }

    public function destroy($id)
    {
        $reportGoal = $this->getReportGoal($id);
        $reportGoal->delete();

        return [True];
    }


}