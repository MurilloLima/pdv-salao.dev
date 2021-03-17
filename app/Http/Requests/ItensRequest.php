<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItensRequest extends FormRequest
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
            'servico' => 'required',
            'valor' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'servico.required' => 'Descreva o tipo de serviço.',
            'valor.min' => 'O valor possui um formato inválido.'
        ];
    }
}
