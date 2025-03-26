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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("title",200)->unique();
            $table->string("excerpt",500);
            $table->string("description");
            $table->string("image_url");
            $table->dateTime("event_start");
            $table->dateTime("event_end")->nullable();  // When empty, considered 1-day event
            $table->string("location",200);
            $table->double("entry_fee")->default(0);
            $table->integer("registered_people")->default(0);
            $table->foreignId("company_id")->constrained("event_companies")->cascadeOnDelete();
            $table->boolean("edit_lock")->default(false); // If someone is editing the event, others can't access.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
