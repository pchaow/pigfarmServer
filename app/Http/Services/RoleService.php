<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;


use App\Interfaces\Services\IRoleService;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleService implements IRoleService
{

    private $searchColumns = [
        'name' => 'like',
        'display_name' => 'like',
        'description' => 'like'
    ];

    private function bindQuerySearchColumns($query, $keyword)
    {
        if ($keyword == '') {
            return $query;
        }
        foreach ($this->searchColumns as $key => $opts) {
            if ($opts == "like") {
                $query->orWhere($key, $opts, "%$keyword%");
            }
            $query->orWhere($key, $opts, $keyword);
        }

        return $query;
    }

    function getRolesQuery(Request $request)
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
        $query = $this->getRolesQuery($request);
        return $query->get();
    }

    public function getPaginate(Request $request)
    {
        $query = $this->getRolesQuery($request);
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