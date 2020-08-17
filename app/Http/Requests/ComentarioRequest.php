<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ComentarioRequest extends FormRequest
{
    public function authorize()
    {
        if (!Auth::guest()) {
            return true;
        } else {
            return false;
        }
    }

    public function rules()
    {
        return [
            'comentario_com' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'comentario_com.required' => 'Campo comentário é obrigatório'
        ];
    }
}
