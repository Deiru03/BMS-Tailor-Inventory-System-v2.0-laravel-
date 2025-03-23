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
        'category_id',
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
}
