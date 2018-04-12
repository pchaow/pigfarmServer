<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRequest
 * @package App\Http\Requests
 */
class ChoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /* @var  User $user */
        $user = \Auth::user();
        $authorize = $user->hasRole(['admin', 'superadmin']);
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
        $item = $this->get('id');

        switch ($this->method()) {
            case "POST" :
                $rules = [
                    'name' => 'required|string|max:20|unique:choices',
                    'display_name' => 'required|string|max:255',
                    'description' => 'string',
                    'children_fields' => 'json|nullable',
                ];
                break;
            case "PUT" :
            case "PATCH" :
                $rules = [
                    'name' => "required|string|max:20|unique:choies,$item",
                    'display_name' => 'required|string|max:255',
                    'description' => 'string',
                    'children_fields' => 'json|nullable',
                ];
                break;
            case "DELETE" :
            default :
                break;
        }

        return $rules;
    }
}
