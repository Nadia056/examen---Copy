<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protagonistas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('actor_id')
            ->constrained('actors')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->foreignId('pelicula')
            ->constrained('peliculas')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protagonistas_');
    }
};
