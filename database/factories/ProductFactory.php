<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->words(5, false),
            'description' => $this->faker->text(5000),
            'category_id' => $this->faker->numberBetween(1, 5),
            'subcategory_id' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 1, 50000),
            'stock' => $this->faker->numberBetween(1, 1000000000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
