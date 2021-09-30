<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'order_id' => Order::factory(),
            'primary' => $this->faker->boolean,
            'country' => $this->faker->country,
            'street_line_1' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'street_line_2' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'city' => $this->faker->city,
            'state' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'zip_code' => $this->faker->regexify('[A-Za-z0-9]{400}'),
        ];
    }
}
