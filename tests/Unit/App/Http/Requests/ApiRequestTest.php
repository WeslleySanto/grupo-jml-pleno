<?php

namespace Tests\Unit\App\Http\Requests;

use Mockery;
use Tests\TestCase;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\ApiRequest;

class ApiRequestTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testAuthorize()
    {
        $request = new ApiRequest();

        $this->assertTrue($request->authorize(), 'The authorize method should return true.');
    }

    public function testFailedValidation()
    {
        $request = Mockery::mock(ApiRequest::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();
        $validatorMock = Mockery::mock(Validator::class);

        $validatorMock
            ->shouldReceive('errors')
            ->once()
            ->andReturn(['field' => ['This field is required.']]);

        $this->expectException(HttpResponseException::class);

        $request->failedValidation($validatorMock);
    }

    public function testBuildFailedValidationResponse()
    {
        $request = new ApiRequest();
        $errors = ['field' => ['This field is required.']];

        $response = $request->buildFailedValidationResponse($errors);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals([
            'message' => 'Validation error',
            'errors' => $errors,
        ], $response->getData(true));
    }
}
