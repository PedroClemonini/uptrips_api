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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('tripDate');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('totalPriceInCents');
            $table->enum('status', array('Pending', 'Confirmed', 'Cancelled', 'InProgress', 'Completed'))->nullable()->change();
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
    }
};
