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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('front_user_id')->constrained('front_users')->onDelete('cascade');
            $table->string('name');
            $table->date('birthdate');
            $table->string('photo');
            $table->boolean('isActive');
            //$table->date('created_at'); Me da error si las pongo en la migración, entiendo que son automaticas de laravel
            //$table->date('updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
