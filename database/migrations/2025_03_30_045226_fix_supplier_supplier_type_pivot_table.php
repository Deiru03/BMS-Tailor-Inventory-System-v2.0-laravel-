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
        Schema::table('supplier_supplier_type', function (Blueprint $table) {
            // Drop the incorrect column if it exists
            if (Schema::hasColumn('supplier_supplier_type', 'supplier_info_id')) {
                $table->dropForeign(['supplier_info_id']);
                $table->dropColumn('supplier_info_id');
            }

            // Add the correct foreign key column
            if (!Schema::hasColumn('supplier_supplier_type', 'supplier_id')) {
                $table->foreignId('supplier_id')
                    ->constrained('supplier_infos')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier_supplier_type', function (Blueprint $table) {
            // Reverse the changes
            if (Schema::hasColumn('supplier_supplier_type', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
                $table->dropColumn('supplier_id');
            }

            // Optionally, re-add the incorrect column (not recommended)
            $table->foreignId('supplier_info_id')
                ->constrained('supplier_infos')
                ->onDelete('cascade');
        });
    }
};