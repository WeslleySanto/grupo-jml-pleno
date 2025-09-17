<?php

namespace Tests\Unit\Services;

use App\Repositories\FornecedorRepository;
use App\Services\FornecedorService;
use Mockery;
use Tests\TestCase;

class FornecedorServiceTest extends TestCase
{
    private $fornecedorRepositoryMock;
    private $fornecedorService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fornecedorRepositoryMock = Mockery::mock(FornecedorRepository::class);
        $this->fornecedorService = new FornecedorService($this->fornecedorRepositoryMock);
    }

    public function testStore()
    {
        $data = ['nome' => 'Fornecedor Teste', 'cnpj' => '12345678901234'];
        $this->fornecedorRepositoryMock
            ->shouldReceive('store')
            ->once()
            ->with(Mockery::on(function ($arg) use ($data) {
                return $arg['nome'] === $data['nome'] && $arg['cnpj'] === $data['cnpj'] && isset($arg['criado_em']);
            }));

        $this->fornecedorService->store($data);
    }

    public function testSearch()
    {
        $data = ['search' => 'Fornecedor'];
        $expectedResult = ['Fornecedor1', 'Fornecedor2'];

        $this->fornecedorRepositoryMock->shouldReceive('search')->once()->with($data['search'])->andReturn($expectedResult);

        $result = $this->fornecedorService->search($data);

        $this->assertEquals($expectedResult, $result);
    }
}
