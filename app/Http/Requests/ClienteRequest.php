<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'name' => 'required|min:3',
            'fone' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'fone.required' => 'Telefone obrigatório',
            'name.required' => 'Infome o nome do cliente',
            'avatar.image' => 'Escolha uma imagem.',
            'avatar.mimes' => 'Formato de imagem inválido.'
        ];
    }
}
