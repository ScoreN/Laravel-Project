<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'postName' => 'required|min:3|max:60',
            'Content' => 'required|min:10',
            'categoryAdd' => 'required',
            'Img' => 'mimes:jpeg,jpg,png,gif|max:1000000'
        ];
    }
}
