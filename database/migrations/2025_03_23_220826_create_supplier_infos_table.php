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
        Schema::create('supplier_infos', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_id')->unique(); // Custom reference number
            $table->string('name'); // Could be company or individual name
            $table->string('contact_person')->nullable(); // Optional for individual suppliers
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable(); // Province in Philippines
            
            // Basic business details
            $table->string('tin')->nullable(); // Tax Identification Number
            
            // Supplier category
            $table->enum('supplier_type', [
                'fabric', 
                'accessories', 
                'thread', 
                'buttons', 
                'zippers', 
                'equipment',
                'other'
            ]);
            
            // Simple relationship data
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_infos');
    }
};
