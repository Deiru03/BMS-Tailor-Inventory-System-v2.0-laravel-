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
        // Create the supplier_types table
        Schema::create('supplier_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., fabric, accessories, etc.
            $table->timestamps();
        });

        // Create the pivot table for suppliers and supplier types
        Schema::create('supplier_supplier_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('supplier_infos')->onDelete('cascade');
            $table->foreignId('supplier_type_id')->constrained('supplier_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_supplier_type');
        Schema::dropIfExists('supplier_types');
    }
};
