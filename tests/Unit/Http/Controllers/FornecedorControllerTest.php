<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\FornecedorController;
use App\Http\Requests\Fornecedores\SearchRequest;
use App\Http\Requests\Fornecedores\StoreFornecedorRequest;
use App\Services\FornecedorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class FornecedorControllerTest extends TestCase
{
    private $fornecedorServiceMock;
    private $fornecedorController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fornecedorServiceMock = Mockery::mock(FornecedorService::class);
        $this->fornecedorController = new FornecedorController($this->fornecedorServiceMock);
    }

    public function testStore()
    {
        $this->fornecedorServiceMock
            ->shouldReceive('store')
            ->once()
            ->with(['validated_data'])
            ->andReturnNull();

        $mockRequest = Mockery::mock(StoreFornecedorRequest::class);
        $mockRequest->shouldReceive('validated')->once()->andReturn(['validated_data']);

        $response = $this->fornecedorController->store($mockRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals(['message' => 'Fornecedor criado com sucesso!'], $response->getData(true));
    }

    public function testSearch()
    {
        $this->fornecedorServiceMock
            ->shouldReceive('search')
            ->once()
            ->with(['validated_data'])
            ->andReturn(['fornecedor1', 'fornecedor2']);

        $mockRequest = Mockery::mock(SearchRequest::class);
        $mockRequest->shouldReceive('validated')->once()->andReturn(['validated_data']);

        $response = $this->fornecedorController->search($mockRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals(['data' => ['fornecedor1', 'fornecedor2']], $response->getData(true));
    }
}
