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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->string('name');
            $table->foreignId('category_id')->constrained('category_products');
            $table->foreignId('supplier_id')->nullable()->constrained('supplier_infos');
            $table->text('description')->nullable();
            
            // Inventory details
            $table->decimal('stock_quantity', 10, 2)->default(0);
            $table->string('unit')->default('piece'); // meter, yard, piece, etc.
            $table->decimal('unit_price', 10, 2);
            $table->decimal('cost_price', 10, 2)->nullable();
            
            // Product attributes - tailoring specific
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('material')->nullable();
            $table->string('brand')->nullable();
            $table->string('pattern')->nullable(); // For fabrics
            
            // Inventory management
            $table->decimal('reorder_level', 10, 2)->nullable(); // When to reorder
            $table->string('location')->nullable(); // Storage location
            
            // Status
            $table->enum('status', ['in_stock', 'low_stock', 'out_of_stock', 'discontinued'])->default('in_stock');
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
