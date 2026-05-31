<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->id('property_id');
            $table->string('type');
            $table->decimal('price', 12, 2);
            $table->string('location');
            $table->timestamps();
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('name');
            $table->string('phone', 30);
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id('trans_id');
            $table->foreignId('client_id')->constrained('clients', 'client_id')->cascadeOnDelete();
            $table->foreignId('property_id')->constrained('properties', 'property_id')->cascadeOnDelete();
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('properties');
        Schema::dropIfExists('users');
    }
};
