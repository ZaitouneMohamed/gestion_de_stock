<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word(),
            'stock'=>$this->faker->numberBetween($min = 10, $max = 100),
            'description'=>$this->faker->text(),
            'categorie_id'=>$this->faker->numberBetween($min = 1, $max = 10),
            'uniteé_id'=>$this->faker->numberBetween($min = 1, $max = 10),
            'user_id'=>1,
            'prix'=>$this->faker->numberBetween($min = 50, $max = 400),
            'stock_mini'=>$this->faker->numberBetween($min = 10, $max = 100),
        ];
    }
}
