<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditUserRequest extends Request
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

    public function __construct(){
      Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
          return Hash::check($value, current($parameters));
      });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|max:255',
          'lastName' => 'required|max:255',
          'avatar' => 'max:99999999',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|in:' . Auth::user()->password,
        ];
    }
}
