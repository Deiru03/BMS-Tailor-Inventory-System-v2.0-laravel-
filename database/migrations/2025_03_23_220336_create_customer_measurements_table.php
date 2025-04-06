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
        Schema::create('customer_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_info_id')->constrained('customers_infos');
            
            // General measurements
            $table->decimal('height', 5, 2)->nullable(); // Overall height in cm
            $table->decimal('weight', 5, 2)->nullable(); // Weight in kg (optional)
            
            // Upper body measurements
            $table->decimal('neck', 5, 2)->nullable(); // Neck circumference
            $table->decimal('shoulder', 5, 2)->nullable(); // Shoulder width
            $table->decimal('chest', 5, 2)->nullable(); // Chest/bust circumference
            $table->decimal('bust', 5, 2)->nullable(); // For female customers
            $table->decimal('waist', 5, 2)->nullable(); // Waist circumference
            $table->decimal('hip', 5, 2)->nullable(); // Hip circumference
            $table->decimal('sleeve_length', 5, 2)->nullable(); // From shoulder to wrist
            $table->decimal('bicep', 5, 2)->nullable(); // Bicep circumference
            $table->decimal('wrist', 5, 2)->nullable(); // Wrist circumference
            $table->decimal('back_width', 5, 2)->nullable(); // Width across back
            $table->decimal('shirt_length', 5, 2)->nullable(); // From shoulder to desired length
            $table->decimal('armhole_depth', 5, 2)->nullable(); // Armhole depth
            
            // Lower body measurements
            $table->decimal('thigh', 5, 2)->nullable(); // Thigh circumference
            $table->decimal('knee', 5, 2)->nullable(); // Knee circumference
            $table->decimal('calf', 5, 2)->nullable(); // Calf circumference
            $table->decimal('ankle', 5, 2)->nullable(); // Ankle circumference
            $table->decimal('inseam', 5, 2)->nullable(); // From crotch to ankle
            $table->decimal('outseam', 5, 2)->nullable(); // From waist to ankle
            $table->decimal('crotch_depth', 5, 2)->nullable(); // Crotch depth
            $table->decimal('front_rise', 5, 2)->nullable(); // Front rise
            $table->decimal('back_rise', 5, 2)->nullable(); // Back rise
            $table->decimal('pants_length', 5, 2)->nullable(); // Total pants length
            
            // Additional measurements for specific garments
            $table->decimal('jacket_length', 5, 2)->nullable(); // For jackets/coats
            $table->decimal('collar', 5, 2)->nullable(); // Collar size
            $table->decimal('shorts_length', 5, 2)->nullable(); // For shorts

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_measurements');
    }
};
