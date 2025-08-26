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
    Schema::create('quote_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('quote_id')->constrained()->onDelete('cascade'); // links to quotes
        $table->string('name');      // product or task
        $table->integer('quantity')->default(1);
        $table->decimal('price', 10, 2)->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_items');
    }
};
