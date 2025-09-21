<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $weight = $this->faker->randomFloat(1, 40, 120);
        $tall = $this->faker->randomFloat(2, 130, 200); // in meters
        $tallinMeters = $tall / 100 ;
        $bmi = round($weight / ($tallinMeters * $tallinMeters), 1);
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'age' => $this->faker->numberBetween(18, 80),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'card_number' => strtoupper($this->faker->bothify('CARD-####-??')),
            'interventions' => json_encode($this->faker->randomElements(
                ['Liposuccion', 'Abdominoplastie', 'Rhinoplastie', 'Mammoplastie'],
                $this->faker->numberBetween(0, 3)
            )),
            'chirurgie_generale' => $this->faker->randomElement(['Appendicite', 'Hernie', 'Aucune']),
            'weight' => $weight,
            'tall' => $tall,
            'bmi' => $bmi,
            'morphologie' => $this->faker->randomElement(['Ectomorphe', 'Mésomorphe', 'Endomorphe']),
            'peau' => $this->faker->randomElement(['Normale', 'Sèche', 'Grasse', 'Mixte']),
            'graisse' => $this->faker->randomElement(['Faible', 'Moyenne', 'Élevée']),
            'zones' => $this->faker->randomElement(['Abdomen', 'Cuisse', 'Bras', 'Visage']),
            'hypertrophie' => $this->faker->optional()->word(),
            'ptose' => $this->faker->optional()->word(),
            'asymetrie' => $this->faker->optional()->word(),
            'operations_precedentes' => $this->faker->optional()->sentence(),
            'complications' => $this->faker->optional()->sentence(),
            'tabac' => $this->faker->randomElement(['oui', 'non']),
            'alcool' => $this->faker->randomElement(['oui', 'non']),
            'autres_habitudes' => $this->faker->optional()->sentence(),
        ];
    }
}
