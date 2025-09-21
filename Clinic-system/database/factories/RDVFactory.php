<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RDV;

class RDVFactory extends Factory
{
    protected $model = RDV::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'date' => $this->faker->dateTimeBetween('now', '+3 month'),
            'time' => $this->faker->numberBetween(8, 18) . ':' . $this->faker->randomElement(['00','30']),
            'service' => $this->faker->randomElement(['consultation','esthetique','Laser Epilasion','botox','filler','hydrafacial','HIFU visage','HIFU vaginal','Drainage lymphatique','cavitation','Radio frequence']),
            'message' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'type' => $this->faker->randomElement(['bloc', 'clinique']),
        ];
    }
}
