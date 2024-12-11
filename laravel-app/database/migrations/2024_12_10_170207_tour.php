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
            $table->string("name");
            $table->string("description");
            $table->string('company');
            $table->string('document');
            $table->string("maintainer_phone");
            $table->string("maintainer_email");
            $table->string("image1_path");
            $table->string("image2_path");
            $table->string("image3_path");
            $table->string("image4_path");
            $table->string("image5_path");
            $table->string("image6_path");
            $table->string("image7_path");
            $table->decimal("child_value");
            $table->decimal("adult_value");
            $table->foreignId('destination_id')->constrained('destination')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
