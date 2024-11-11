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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('boardingPlace');
            $table->string('landingPlace');
            $table->integer('reservationsId');
            $table->integer('transportId');
            $table->integer('numberReservation');
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamps();

            $table->foreignId('reservationsId')->constrained('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('transportId')->constrained('transport')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
