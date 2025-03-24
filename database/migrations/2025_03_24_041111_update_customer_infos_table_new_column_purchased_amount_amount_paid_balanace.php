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
        Schema::table('customers_infos', function (Blueprint $table) {
            $table->decimal('purchased_amount', 10, 2)->default(0)->after('notes');
            $table->decimal('amount_paid', 10, 2)->default(0)->after('purchased_amount');
            $table->decimal('balance', 10, 2)->default(0)->after('amount_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers_infos', function (Blueprint $table) {
            $table->dropColumn(['purchased_amount', 'amount_paid', 'balance']);
        });
    }
};
