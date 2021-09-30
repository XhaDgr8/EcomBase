<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'transaction_id' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'total' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'description' => $this->faker->text,
        ];
    }
}
