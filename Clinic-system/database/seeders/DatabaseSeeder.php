<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\RDV;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            Patient::factory(250)->create();
        RDV::factory(250)->create();
        Payment::factory(250)->create();
        Expense::factory(250)->create();

        User::create([
    'name' => 'Oussama Ayache',
    'email' => 'oussamaayachefff@gmail.com',
    'password' => bcrypt('khalilclinique@Ou$$ama2008'),
    'role' => 'admin',
    ]);
    }
}
