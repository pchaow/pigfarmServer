<?php

namespace App\Http\Controllers\Farm;

use App\Http\Services\PigService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PigController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
        return $this->pigService->getPaginate($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->pigService->store($request);

    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function show(Request $request, $id)
    {
        return $this->pigService->getPig($request,$id);
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
