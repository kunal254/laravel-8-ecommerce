<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Address as Addresses;

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
            'address_line' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'postal_code' => Addresses::postcode(),
            'country' => $this->faker->country()
        ];
    }
}
