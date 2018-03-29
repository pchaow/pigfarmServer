<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 3/29/2018
 * Time: 10:05 AM
 */

namespace App\Interfaces\Services;


use Illuminate\Http\Request;


/**
 * Interface IRoleService
 * @package App\Interfaces\Services
 */
interface IRoleService
{

    public function getRoles(Request $request);

    public function getPaginate(Request $request);

    public function getRole($id);

    public function store(Request $request);

    public function update(Request $request, $id);

    public function destroy($id);
}