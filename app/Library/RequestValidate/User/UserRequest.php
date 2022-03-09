<?php namespace Mocono\RequestValidate\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Mocono\Enums\Upload;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.request()->user_id,
];

    }

    public function prepareRequest()
    {
        $data = [
            'name' => request()->name,
            'email' => request()->email,
            'password' => (request()->password) ? Hash::make(request()->password) : Hash::make('12345678'),
            'type' => 2,
            'status' => 1,
        ];
//dd($data);
        return $data;
    }



}
