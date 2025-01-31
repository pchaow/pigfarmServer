<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{

    protected $searchColumns = [
        'name' => 'like',
        'email' => 'like',
        'username' => 'like'
    ];

    function getQuery(Request $request)
    {
        $query = User::query();

        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query = $this->bindQuerySearchColumns($query, $keyword);
        }
        if ($request->has('with')) {
            $query = $this->bindWith($query, $request->get('with'));
        }
        return $query;
    }

    public function getUsers(Request $request)
    {
        $query = $this->getQuery($request);
        return $query->get();
    }

    public function getPaginate(Request $request)
    {
        $query = $this->getQuery($request);
        return $query->paginate();
    }

    public function getUser(Request $request,$id)
    {
        $with = $request->get('with');
        $query = User::query();
        $query->with($with);
        $query->where('id',$id);
        $user = $query->first();
        return $user;
    }

    public function store(Request $request)
    {

        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $roles = $request->get('roles');
        $ids = array_pluck($roles, 'id');
        $user->roles()->sync(($ids));

        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return abort(404, "User not found");
        }

        $user->fill($request->all());
        if ($request->has('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        $roles = $request->get('roles');
        $ids = array_pluck($roles, 'id');
        $user->roles()->sync(($ids));

        return $user;
    }

    public function destroy($id)
    {
        /** @var User $user */
        $user = User::find($id);
        if (!$user) {
            return abort(404, "User not found");
        }
        $user->delete();
        return [true];
    }


}