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
        Schema::create('company_contact', function (Blueprint $table) {
            $table->id();
            $table->string('companyName');
            $table->string('cnpj');
            $table->string('phone');
            $table->string('phoneSecondary');
            $table->string('email')->nullable(false);
            $table->string('emailSupport')->nullable();
            $table->string('address');
            $table->string('cep');
            $table->string('openingHours');
            $table->string('linkFacebook');
            $table->string('linkInstagram');
            $table->string('linkWhatsapp');
            $table->string('logoUrl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_contact');
    }
};
