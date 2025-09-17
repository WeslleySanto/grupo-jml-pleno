<?php

namespace App\Services;

use App\Repositories\FornecedorRepository;

class FornecedorService
{
    /**
     * Create a new class instance.
     *
     * @param FornecedorRepository $fornecedorRepository
     */
    public function __construct(
        private FornecedorRepository $fornecedorRepository
    ) {}

    /**
     * Store a new fornecedor in the database.
     *
     * @param array $data
     * @return void
     * 
     * @todo @covers tests/Unit/Http/Controllers/FornecedorControllerTest.php::testStore
     */
    public function store(array $data): void
    {
        $data['criado_em'] = now();

        $this->fornecedorRepository->store($data);
    }

    /**
     * Search for fornecedores based on criteria.
     *
     * @param array $data
     * @return array
     * 
     * @todo @covers tests/Unit/Http/Controllers/FornecedorControllerTest.php::testSearch
     */
    public function search(array $data): array
    {
        return $this->fornecedorRepository->search($data['search']);
    }
}
