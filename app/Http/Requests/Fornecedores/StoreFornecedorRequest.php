<?php

namespace App\Http\Requests\Fornecedores;

use App\Http\Requests\ApiRequest;

class StoreFornecedorRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     * 
     * @covers tests/Unit/App/Http/Requests/Fornecedores/StoreFornecedorRequestTest::testRules
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|min:3',
            'cnpj' => 'required|integer|digits:14|unique:fornecedores,cnpj',
            'email' => 'nullable|string|email',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     * 
     * @covers tests/Unit/App/Http/Requests/Fornecedores/StoreFornecedorRequestTest::testMessages
     */
    public function messages(): array
    {
        return [
            'nome.min' => 'nome curto',
            'cnpj.digits' => 'cnpj invalido',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     * 
     * @covers tests/Unit/App/Http/Requests/Fornecedores/StoreFornecedorRequestTest::testPrepareForValidation
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'cnpj' => preg_replace('/\D+/', '', $this->cnpj),
        ]);
    }
}
