<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Item name
            $table->text('description')->nullable(); // Description
            $table->decimal('price', 10, 2)->nullable(); // Price
            $table->integer('default_quantity')->default(1); // Default Quantity
            $table->integer('max_quantity')->nullable(); // Max Quantity
            $table->enum('tax_category', ['Physical Goods', 'Digital Services', 'Consulting'])
                  ->default('Physical Goods'); // Tax Category
            $table->string('image_url')->nullable(); // Image URL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
