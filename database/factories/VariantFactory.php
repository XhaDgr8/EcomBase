<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;

class VariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Variant::class;

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
            'option' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'value' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'sku' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'stock' => $this->faker->numberBetween(-10000, 10000),
            'display' => $this->faker->regexify('[A-Za-z0-9]{400}'),
        ];
    }
}
