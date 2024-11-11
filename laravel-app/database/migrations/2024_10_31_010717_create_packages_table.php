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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('packageName')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('tripId');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('maxPeople');
            $table->timestamps();

            $table->foreignId('tripId')->constrained('trips')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
