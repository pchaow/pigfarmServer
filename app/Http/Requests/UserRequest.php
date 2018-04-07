<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRequest
 * @package App\Http\Requests
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        $authorize = false;
        switch ($this->method()) {
            case "GET" :
                $authorize = $user->can('read-users') || $user->id = $this->get('id');
                break;
            case "POST" :
                $authorize = $user->can('create-users');
                break;
            case "PUT" :
            case "PATCH" :
                $authorize = $user->can('update-users');
                break;
            case "DELETE" :
                $authorize = $user->can('delete-users') && $this->get('id') != $user->id;
                break;
            default :
                break;
        }
        return $authorize;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $user = $this->get('id');

        switch ($this->method()) {
            case "POST" :
                $rules = [
                    'name' => 'required|string|max:255',
                    'username' => 'required|string|max:20|unique:users',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
                ];
                break;
            case "PUT" :
            case "PATCH" :
                $rules = [
                    'email' => "required|email|max:255|unique:users,email,$user",
                    'username' => "required|max:255|unique:users,username,$user",
                    'name' => 'required|max:255',
                    'password' => 'min:6|confirmed|nullable|same:password_confirmation',
                ];
                break;
            case "DELETE" :
            default :
                break;
        }

        return $rules;
    }
}
