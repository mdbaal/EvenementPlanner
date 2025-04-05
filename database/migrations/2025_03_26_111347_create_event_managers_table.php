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
        Schema::create('event_managers', function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->foreignId("company_id")->constrained("event_companies")->cascadeOnDelete();
            $table->string("assigned_events")->default("any"); // CSV list of assigned events. If assigned 'any', manager won't be restricted.
            $table->boolean("can_create_managers")->default(false); // In case a company needs more than one person/account that can create managers.
            $table->timestamps();
        });
    }
    // TODO: Transfer this to user model.
    // TODO: Add roles (
    //      event_manager - can create, edit and delete events,
    //      company_manager - In addition to even_manager can create more managers and edit company info,
    //      administrator - Belongs to the 'first' company, is allowed to add more companies, add and edit managers and has access to all events.
    //      )
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_managers');
    }
};
