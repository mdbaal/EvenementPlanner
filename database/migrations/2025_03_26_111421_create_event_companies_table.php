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
        Schema::create('event_companies', function (Blueprint $table) {
            $table->id();
            $table->string("name",200);
            $table->string("description");
            $table->string("phone",15)->nullable(); // Not all companies have customer service via phone
            $table->string("email"); // But require an email for the 'main' company and visitors with questions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_companies');
    }
};
