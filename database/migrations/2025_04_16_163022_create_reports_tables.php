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
        // Create the sales_reports table
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->id();
            $table->string('sale_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_status')->nullable();
            $table->timestamp('sale_date')->nullable();
            $table->timestamps();
        });

        // Create the invoice_reports table
        Schema::create('invoice_reports', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->string('sale_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->timestamp('issued_at')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

        // Create the expense_reports table
        Schema::create('expense_reports', function (Blueprint $table) {
            $table->id();
            $table->string('material_code')->nullable();
            $table->string('name')->nullable();
            $table->decimal('cost_price', 10, 2)->default(0);
            $table->string('supplier_name')->nullable();
            $table->string('supplier_type')->nullable();
            $table->timestamp('expense_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_reports');
        Schema::dropIfExists('invoice_reports');
        Schema::dropIfExists('expense_reports');
    }
};
