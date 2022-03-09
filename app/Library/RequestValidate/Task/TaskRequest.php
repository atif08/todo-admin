<?php

namespace Mocono\RequestValidate\Task;

use Illuminate\Foundation\Http\FormRequest;
use Mocono\Enums\Upload;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=>'required',
            'description'=>'required',
        ];
    }

    public function prepareRequest()
    {
       return $data = [
            'user_id' => auth()->user()->id,
            'title' => request()->title,
            'description' => request()->description,
            'due_at' => request()->due_at,
            'status' => (request()->status)?1:0
        ];
    }
}
