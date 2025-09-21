<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'patient_id' => Patient::inRandomOrder()->first()?->id ?? Patient::factory(),
            'amount' => $this->faker->numberBetween(1000, 100000),
            'method' => $this->faker->randomElement(['Espèces', 'Cheque', 'CCP']),
            'payment_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'notes' => $this->faker->sentence,
        ];
    }
}
