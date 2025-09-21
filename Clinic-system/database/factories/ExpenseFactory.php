<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'amount' => $this->faker->numberBetween(500, 50000),
            'expense_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'notes' => $this->faker->sentence,
        ];
    }
}
