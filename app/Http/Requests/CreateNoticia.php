<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNoticia extends FormRequest
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
            'titulo'=> 'required',
            //'copete'=> 'required',
            'descripcion'=>'required',
          //'imagen'=> 'mimes:jpg,jpeg,png,bmp,gif,svg,webp', 
            'imagen'=> 'image'
        ];
    }
}
