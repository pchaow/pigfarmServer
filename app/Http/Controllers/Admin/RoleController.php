<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\RoleService;
use App\Interfaces\Services\IRoleService;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class RoleController
 * @package App\Http\Controllers\Admin
 */
class RoleController extends Controller
{
    private $roleService;


    /**
     * RoleController constructor.
     * @param IRoleService $IRoleService
     */
    public function __construct(IRoleService $IRoleService)
    {
        $this->roleService = $IRoleService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->roleService->getPaginate($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $this->roleService->store($request);
        return $role;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->roleService->getRole($id);
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
        /** @var Role $role */
        $role = $this->roleService->update($request, $id);
        return $role;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->roleService->destroy($id);
        return $role;
    }
}
