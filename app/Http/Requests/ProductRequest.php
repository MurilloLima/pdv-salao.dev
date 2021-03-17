<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique:products',
            'desc' => 'required',
            'qtd' => 'required',
            'valor' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Informe o produto.',
            'desc.required' => 'Informe a descrição do produto.',
            'qtd.required' => 'Informe a quantidade.',
            'valor.required' => 'Informe o valor.',
        ];
    }
}
