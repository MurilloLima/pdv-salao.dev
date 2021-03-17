<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'valor_dinheiro' => 'min:3',
            'valor_cartao' => 'min:3',

        ];
    }

    public function messages()
    {
        return [
            'valor_dinheiro.min' => 'O valor possui um formato inválido.',
            'valor_cartao.min' => 'O valor possui um formato inválido.'
        ];
    }
}
