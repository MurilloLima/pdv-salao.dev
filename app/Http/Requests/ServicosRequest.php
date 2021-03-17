<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicosRequest extends FormRequest
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
            'name' => 'required|unique:servicos',
            'valor' => 'required'
        ];
    }

    public function messages()
    {
     return [
        'name.required' => 'Informe o nome do serviço.',
        'name.unique' => 'Serviço já se encontra cadastrado no sistema.'

     ];
    }
}
