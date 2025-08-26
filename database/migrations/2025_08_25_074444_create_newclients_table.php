<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newclients', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // NewClient name
            $table->string('email')->nullable(); // Optional email
            $table->string('phone')->nullable(); // Optional phone
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newclients');
    }
};
