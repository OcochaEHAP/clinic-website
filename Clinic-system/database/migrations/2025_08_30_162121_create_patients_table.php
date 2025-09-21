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
        Schema::create('patients', function (Blueprint $table) {
    $table->id();
    $table->string('first_name');
    $table->string('last_name');
    $table->integer('age')->nullable();
    $table->string('address')->nullable();
    $table->string('phone')->nullable();
    $table->string('card_number')->nullable();
    $table->json('interventions')->nullable();
    $table->string('chirurgie_generale')->nullable();
    $table->float('weight')->nullable();
    $table->float('tall')->nullable();
    $table->float('bmi')->nullable();
    $table->string('morphologie')->nullable();
    $table->string('peau')->nullable();
    $table->string('graisse')->nullable();
    $table->string('zones')->nullable();
    $table->string('hypertrophie')->nullable();
    $table->string('ptose')->nullable();
    $table->string('asymetrie')->nullable();
    $table->text('operations_precedentes')->nullable();
$table->text('complications')->nullable();
$table->enum('tabac', ['oui', 'non'])->default('non');
$table->enum('alcool', ['oui', 'non'])->default('non');
$table->string('autres_habitudes')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
