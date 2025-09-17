<?php

namespace App\Http\Requests\Fornecedores;

use App\Http\Requests\ApiRequest;
use Mews\Purifier\Facades\Purifier;

class SearchRequest extends ApiRequest
{
    /**
     * Rules that apply to the request.
     *
     * @return array
     * 
     * @covers tests/Unit/App/Http/Requests/Fornecedores/SearchRequestTest::testRules
     */
    public function rules(): array
    {
        return [
            'search'   => 'required|string|max:255',
        ];
    }

    /**
     * Sanitize the resolved request data.
     *
     * @return void
     *
     * @covers tests/Unit/App/Http/Requests/Fornecedores/SearchRequestTest::testSanitizeResolved
     */
    public function sanitizeResolved()
    {
        $this->merge([
            'search' => Purifier::clean($this->input('search')),
        ]);
    }
}
