<?php

namespace App\Repositories;

use App\Models\Fornecedor;

class FornecedorRepository
{
    /**
     * Store a new fornecedor in the database.
     *
     * @param array $data
     * @return Fornecedor
     * 
     * @codeCoverageIgnore
     */
    public function store(array $data): Fornecedor
    {
        return Fornecedor::create($data);
    }

    /**
     * Search for fornecedores based on criteria.
     *
     * @param string $nome
     * @return array
     * 
     * @codeCoverageIgnore
     */
    public function search(string $nome): array
    {
        return Fornecedor::select('id', 'nome', 'cnpj', 'email', 'criado_em')
            ->where('nome', 'like', '%' . $nome . '%')
            ->orderByDesc('criado_em')
            ->limit(50)
            ->get()
            ->toArray();
    }
}
