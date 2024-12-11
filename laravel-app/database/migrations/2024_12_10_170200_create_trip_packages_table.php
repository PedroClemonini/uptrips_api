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

        Schema::create('trip_package', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->string("image1_path");
            $table->string("image2_path");
            $table->string("image3_path");
            $table->string("image4_path");
            $table->string("image5_path");
            $table->string("image6_path");
            $table->string("image7_path");
            $table->date("start_date");
            $table->date("end_date");
            $table->enum('status', ['active','inactive']);
            $table->decimal("child_value", 10, 2);
            $table->decimal("adult_value", 10, 2);
            $table->foreignId('destination_id')->constrained('destination')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('hosting_id')->constrained('hosting')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::dropIfExists('tripPackage');
    }
};
