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
        Schema::create('tour', function (Blueprint $table) {
            $table->id();
            $table->integer('reservationId');
            $table->string('tourName');
            $table->text('description');
            $table->dateTime('duration');
            $table->integer('price');
            $table->date('availableDate');
            $table->timestamps();

            $table->foreignId('reservationId')->constrained('reservations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour');
    }
};
