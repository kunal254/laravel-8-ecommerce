<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'card_type' => $this->faker->creditCardType(),
            // need to change
            'card_number' => $this->faker->creditCardNumber(),
            'card_expiry' => $this->faker->creditCardExpirationDateString(),
            'cvv' => rand(100, 999)
        ];
    }
}
