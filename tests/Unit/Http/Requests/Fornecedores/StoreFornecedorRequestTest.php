<?php

namespace Tests\Unit\Http\Requests\Fornecedores;

use App\Http\Requests\Fornecedores\StoreFornecedorRequest;
use Tests\TestCase;

class StoreFornecedorRequestTest extends TestCase
{
    public function testRules()
    {
        $rules = (new StoreFornecedorRequest())->rules();

        $this->assertArrayHasKey('nome', $rules);
        $this->assertArrayHasKey('cnpj', $rules);
        $this->assertArrayHasKey('email', $rules);
    }

    public function testMessages()
    {
        $request = new StoreFornecedorRequest();
        $messages = $request->messages();

        $this->assertArrayHasKey('nome.min', $messages);
        $this->assertEquals('nome curto', $messages['nome.min']);

        $this->assertArrayHasKey('cnpj.digits', $messages);
        $this->assertEquals('cnpj invalido', $messages['cnpj.digits']);
    }

    public function testPrepareForValidation()
    {
        $request = new StoreFornecedorRequest();
        $request->merge(['cnpj' => '12.345.678/9012-34']);

        $request->prepareForValidation();

        $this->assertEquals('12345678901234', $request->input('cnpj'));
    }
}
