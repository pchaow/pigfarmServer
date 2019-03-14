<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChoiceRequest;
use App\Http\Services\ChoiceService;
use Illuminate\Http\Request;

/**
 * Class ChoiceController
 * @package App\Http\Controllers\Admin
 */
class ChoiceController extends Controller
{
    /**
     * ChoiceController constructor.
     */
    public function __construct(ChoiceService $choiceService)
    {
        $this->choiceService = $choiceService;
    }


    /**
     * @param ChoiceRequest $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(ChoiceRequest $request)
    {
        return $this->choiceService->getPaginate($request);
    }


    /**
     * @param ChoiceRequest $request
     * @return \App\Models\Choice
     */
    public function store(ChoiceRequest $request)
    {
        return $this->choiceService->store($request);
    }


    /**
     * @param ChoiceRequest $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function show(ChoiceRequest $request, $id)
    {
        return $this->choiceService->getChoice($request, $id);
    }


    /**
     * @param ChoiceRequest $request
     * @param $id
     */
    public function update(ChoiceRequest $request, $id)
    {
        return $this->choiceService->update($request, $id);

    }


    /**
     * @param ChoiceRequest $request
     * @param $id
     * @return array|void
     */
    public function destroy(ChoiceRequest $request, $id)
    {
        return $this->choiceService->destroy($id);

    }
}
