<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bloc_payments', function (Blueprint $table) {
            $table->id();
                $table->foreignId('patient_id')->nullable()->constrained()->onDelete('set null');
                $table->decimal('amount', 10, 2);

                // fixed expenses
                $table->decimal('location_de_bloc', 10, 2)->default(0);
                $table->decimal('aide', 10, 2)->default(0);
                $table->decimal('la_gaine', 10, 2)->default(0);

                $table->date('date');
                $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloc_payments');
    }
};
