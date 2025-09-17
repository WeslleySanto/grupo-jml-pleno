<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\FornecedorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fornecedores\SearchRequest;
use App\Http\Requests\Fornecedores\StoreFornecedorRequest;

class FornecedorController extends Controller
{
    /**
     * Create a new class instance.
     *
     * @param FornecedorService $fornecedorService
     */
    public function __construct(
        private FornecedorService $fornecedorService
    ) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFornecedorRequest $request
     * @return JsonResponse
     * 
     * @covers tests/Unit/App/Http/Controllers/FornecedorControllerTest::testStore
     */
    public function store(StoreFornecedorRequest $request): JsonResponse
    {
        $this->fornecedorService->store($request->validated());
        return response()->json(['message' => 'Fornecedor criado com sucesso!'], Response::HTTP_CREATED);
    }

    /**
     * Search for a resource in storage.
     *
     * @param SearchRequest $request
     * @return JsonResponse
     * 
     * @covers tests/Unit/App/Http/Controllers/FornecedorControllerTest::testSearch
     */
    public function search(SearchRequest $request): JsonResponse
    {
        $fornecedores = $this->fornecedorService->search($request->validated());
        return response()->json(['data' => $fornecedores], Response::HTTP_OK);
    }
}
