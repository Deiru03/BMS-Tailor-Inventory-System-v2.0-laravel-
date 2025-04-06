<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = [
        'product_code',
        'name',
        // 'category_id',
        'product_type',
        'supplier_id',
        'description',
        'stock_quantity',
        'unit',
        'unit_price',
        'cost_price',
        'color',
        'size', 
        'material',
        'brand',
        'pattern',
        'reorder_level',
        'location', 
        'status',
        'is_active',
    ];

    // Boot method to define model events
    protected static function boot()
    {
        parent::boot();

        // Trigger the updateLowStockStatus method after creating, updating, or deleting a product
        static::saved(function () {
            self::updateLowStockStatus();
        });

        static::deleted(function () {
            self::updateLowStockStatus();
        });
    }

    // Define the updateLowStockStatus method in the model
    public static function updateLowStockStatus()
    {
        // Update products with stock_quantity between 1 and 10 to "low_stock"
        self::where('stock_quantity', '<=', 10)
            ->where('stock_quantity', '>', 0)
            ->where('status', '!=', 'low_stock')
            ->update(['status' => 'low_stock']);

        // Update products with stock_quantity of 0 to "out_of_stock"
        self::where('stock_quantity', 0)
            ->where('status', '!=', 'out_of_stock')
            ->update(['status' => 'out_of_stock']);

        // Optionally, update products with stock_quantity greater than 10 to "in_stock"
        self::where('stock_quantity', '>', 10)
            ->where('status', '!=', 'in_stock')
            ->update(['status' => 'in_stock']);
    }
}
