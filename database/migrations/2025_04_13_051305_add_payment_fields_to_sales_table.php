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
        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('amount_paid', 10, 2)->default(0)->after('total_amount'); // Amount paid by the customer
            $table->decimal('change_due', 10, 2)->default(0)->after('amount_paid');  // Change to give back to the customer
            $table->decimal('balance', 10, 2)->default(0)->after('change_due');     // Balance in case of partial payment
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['amount_paid', 'change_due', 'balance']);
        });
    }
};
