<?php

namespace App\Http\Controllers\Farm;

use App\Http\Controllers\Controller;
use App\Http\Requests\PigRequest;
use App\Http\Services\PigService;

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
     * @param PigRequest $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(PigRequest $request)
    {
        return $this->pigService->getPaginate($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PigRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PigRequest $request)
    {
        return $this->pigService->store($request);

    }


    /**
     * @param PigRequest $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function show(PigRequest $request, $id)
    {
        $pig = $this->pigService->getPig($request, $id);

        if ($pig) {
            return $pig;
        } else {
            abort(404, "Pig ID is invalid");
        }

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
