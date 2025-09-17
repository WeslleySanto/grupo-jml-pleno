<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->company,
            'cnpj' => $this->faker->numerify('##############'),
            'email' => $this->faker->unique()->safeEmail,
            'criado_em' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
