<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
        // https://github.com/LaravelLegends/pt-br-validator
        // validações pt-br
        // felipe

        return [
            'email' => 'nullable|email|required_without:cpf',
            'cpf' => 'nullable|cpf',
            'password' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo Senha é obrigatório.',
            'email' => 'O campo E-mail não é um e-mail válido.',
            'min' => 'O campo Senha não tem tamanho mínimo válido.',
            'required_without' => 'E-mail ou CPF, é obrigatório.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
         $validator->errors()
        , 422));
    }
}
