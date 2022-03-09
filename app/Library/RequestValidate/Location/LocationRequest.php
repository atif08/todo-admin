<?php

namespace Mocono\RequestValidate\Location;

use Illuminate\Foundation\Http\FormRequest;


class LocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//            'location'=>'unique:locations',
        ];
    }

    public function prepareRequest()
    {
       return $data = [
            'user_id' => auth()->user()->id,
            'latitude' => request()->latitude,
            'longitude' => request()->longitude,
            'location' => request()->location,
            'status' => (request()->status)?1:0
        ];
    }
}
