<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\ReportGoalService;
use App\Models\ReportGoal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ReportGoalController
 * @package App\Http\Controllers\Admin
 */
class ReportGoalController extends Controller
{
    private $reportGoalService;


    /**
     * ReportGoalController constructor.
     * @param ReportGoalService $reportGoalService
     */
    public function __construct(ReportGoalService $reportGoalService)
    {
        $this->reportGoalService = $reportGoalService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('paginate') && $request->get('paginate')== 'false') {
            return $this->reportGoalService->getReportGoals($request);
        }
        return $this->reportGoalService->getPaginate($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reportGoal = $this->reportGoalService->store($request);
        return $reportGoal;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->reportGoalService->getReportGoal($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var ReportGoal $reportGoal */
        $reportGoal = $this->reportGoalService->update($request, $id);
        return $reportGoal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reportGoal = $this->reportGoalService->destroy($id);
        return $reportGoal;
    }
}
