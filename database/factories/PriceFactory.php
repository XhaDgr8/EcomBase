<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Price;
use App\Models\Product;

class PriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Price::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory(),
            'variant_id' => Variant::factory(),
            'price' => $this->faker->numberBetween(-10000, 10000),
            'compare_at_price' => $this->faker->numberBetween(-10000, 10000),
            'cost_price' => $this->faker->numberBetween(-10000, 10000),
            'shipping_price' => $this->faker->numberBetween(-10000, 10000),
            'tax' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
