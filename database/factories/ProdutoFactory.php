<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'descricao' => $this->faker->word(),
            'dimensoes' => $this->faker->word(),
            'codigo' => $this->faker->numberBetween(1000,999999),
            'referencia' => $this->faker->word(),
            'saldo_estoque' => $this->faker->numberBetween(1,100),
            'preco' => $this->faker->numberBetween(1,100),
            'categoria_id' => $this->faker->randomElement(Categoria::pluck('id')),
        ];
    }
}
