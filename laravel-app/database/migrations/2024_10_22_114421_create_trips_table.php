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

        Schema::create('transport', function (Blueprint $table) {
            $table->id();
            $table->enum('type', array('onibus', 'van', 'carro'));
            $table->integer('capacity');
            $table->string('transportCompany');
            $table->string('model');
            $table->string('licensePlate');
            $table->string('manufactureYear');
            $table->timestamps();
        });

        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('boardingPlace');
            $table->string('landingPlace');
            $table->integer('numberReservation');
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamps();

            $table->foreignId('transportId')->constrained('transport')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('packageName')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('maxPeople');
            $table->timestamps();

            $table->foreignId('tripId')->constrained('trips')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('tripDate');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('totalPriceInCents');
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled', 'InProgress', 'Completed'])->nullable();
            $table->text('observations');
            $table->timestamps();

            $table->foreignId('packageId')->constrained('packages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('customerId')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('trips');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('transport');
    }
};
