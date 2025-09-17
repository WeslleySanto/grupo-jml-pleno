<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    /**
     * The authorization logic for the request.
     *
     * @return boolean
     * 
     * @covers tests/Unit/App/Http/Requests/ApiRequestTest::testAuthorize
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     * 
     * @throws HttpResponseException
     * 
     * @covers tests/Unit/App/Http/Requests/ApiRequestTest::testFailedValidation
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException($this->buildFailedValidationResponse($validator->errors()));
    }

    /**
     * Build the failed validation response.
     *
     * @param \Illuminate\Support\MessageBag $errors
     * 
     * @return \Illuminate\Http\JsonResponse
     * 
     * @covers tests/Unit/App/Http/Requests/ApiRequestTest::testBuildFailedValidationResponse
     */
    public function buildFailedValidationResponse($errors): JsonResponse
    {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
