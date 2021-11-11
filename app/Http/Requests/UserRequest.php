<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_type_id'  =>  ['required', 'numeric', 'exists:types_user,id'],
            'name'          =>  ['required', 'string', 'max:45'],
            'last_name'     =>  ['required', 'string', 'max:45'],
            'email'         =>  ['required', 'string', 'email', 'max:255', $this->user() ? Rule::unique('users', 'email')->ignore($this->user->id) : ''],
            'password'      =>  ['required', 'string', 'min:5'],
            'role'          =>  ['string', 'exists:roles,name']
        ];
    }
}
