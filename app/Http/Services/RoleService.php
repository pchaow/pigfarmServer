<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;


use App\Models\Role;
use Illuminate\Http\Request;

class RoleService extends BaseService
{

    protected $searchColumns = [
        'name' => 'like',
        'display_name' => 'like',
        'description' => 'like'
    ];

    function getQuery(Request $request)
    {
        $query = Role::query();

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query = $this->bindQuerySearchColumns($query, $keyword);
        }
        return $query;
    }


    public function getRoles(Request $request)
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
     * @return Role|mixed
     */
    public function getRole($id)
    {
        $role = Role::find($id);
        return $role;
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->fill($request->all());

        $role->save();
        return $role;
    }

    public function update(Request $request, $id)
    {

        $role = $this->getRole($id);
        $role->fill($request->all());
        $role->save();
        return $role;
    }

    public function destroy($id)
    {
        $role = $this->getRole($id);
        $role->delete();

        return [True];
    }


}