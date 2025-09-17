<?php

namespace Tests\Unit\Http\Requests\Fornecedores;

use Mockery;
use Tests\TestCase;
use App\Http\Requests\Fornecedores\SearchRequest;

class SearchRequestTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testRules()
    {
        $request = new SearchRequest();
        $rules = $request->rules();

        $this->assertArrayHasKey('search', $rules);

        $this->assertStringContainsString('string', $rules['search']);
    }

    public function testSanitizeResolved()
    {
        $purifierMock = Mockery::mock('alias:Mews\Purifier\Facades\Purifier');
        $purifierMock->shouldReceive('clean')
            ->once()
            ->with('<script>alert(1)</script>')
            ->andReturn('alert(1)');

        $request = new class(['search' => '<script>alert(1)</script>']) extends SearchRequest {
            public function input($key = null, $default = null)
            {
                return $this->query($key, $default);
            }
        };

        $request->setMethod('GET');
        $request->initialize(['search' => '<script>alert(1)</script>']);

        $request->sanitizeResolved();

        $this->assertEquals('alert(1)', $request->input('search'));
    }
}
