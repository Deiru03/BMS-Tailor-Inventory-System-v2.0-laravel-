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
        Schema::create('category_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // URL-friendly version of name
            $table->text('description')->nullable();
            // Change this line to reference the same table:
            $table->foreignId('parent_id')->nullable(); // First create without constraint
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        // Add the self-referencing constraint after table creation
        Schema::table('category_products', function (Blueprint $table) {
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('category_products')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_products');
    }
};
