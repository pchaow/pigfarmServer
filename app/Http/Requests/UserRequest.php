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

        if ($this->isMethod("POST")) {
            return $user->can('create-users');

        }

        if ($this->isMethod("DELETE")) {
            if ($this->get('id') == $user->id) {
                return false;
            } else {
                return $user->can('delete-users');
            }
        }


        return false;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if ($this->isMethod("POST")) {
            $rules = [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:20|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ];
        }
        return $rules;
    }
}
