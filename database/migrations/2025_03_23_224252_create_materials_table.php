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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('material_code')->unique();
            $table->string('name');
            $table->foreignId('supplier_id')->nullable()->constrained('supplier_infos');
            $table->foreignId('category_id')->nullable()->constrained('category_products');
            $table->text('description')->nullable();
            
            // Material details - tailoring specific
            $table->string('type')->nullable(); // Fabric, button, zipper, thread, etc.
            $table->string('color')->nullable();
            $table->string('pattern')->nullable(); // For fabrics
            $table->string('composition')->nullable(); // e.g., "100% cotton", "polyester blend"
            $table->string('width')->nullable(); // For fabrics, typically in inches/cm
            $table->string('weight')->nullable(); // For fabrics, e.g., "lightweight", "heavy"
            $table->string('quality_grade')->nullable(); // e.g., "premium", "standard"
            
            // Inventory details
            $table->decimal('stock_quantity', 10, 2)->default(0);
            $table->string('unit')->default('meter'); // meter, yard, piece, roll, etc.
            $table->decimal('unit_price', 10, 2);
            $table->decimal('cost_price', 10, 2);
            
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
        Schema::dropIfExists('materials');
    }
};
