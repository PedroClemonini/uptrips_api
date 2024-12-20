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
        Schema::create("reservation", function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('childs');
            $table->tinyInteger('adults');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['awaiting_payment','payed','canceled']);
            $table->dateTime('payment_date');
            $table->foreignId("trip_package_id")->constrained("trip_package")->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
