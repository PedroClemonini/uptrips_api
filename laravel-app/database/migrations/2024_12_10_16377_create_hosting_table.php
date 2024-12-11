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

        Schema::create('hosting', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->string("document");
            $table->string('address');
            $table->string("contact_phone");
            $table->string("contact_email");
            $table->foreignId('destination_id')->constrained('destination')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosting');
    }
};
