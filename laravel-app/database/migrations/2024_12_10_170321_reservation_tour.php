<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservationTour', function (Blueprint $table) {
            $table->id();
            $table->foreignId("reservation_id")->constrained('reservation')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tour_id')->constrained('tour')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('tour_child_value', 10, 2);
            $table->decimal('tour_adult_value', 10, 2);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservationTour');
    }
};
