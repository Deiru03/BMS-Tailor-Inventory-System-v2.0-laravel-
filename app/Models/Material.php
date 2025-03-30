<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $table = 'materials';
    protected $fillable = [
        'material_code',
        'name',
        'supplier_id',
        'category_id',
        'supplier_type_name',
        'description',
        'type',
        'color',
        'pattern',
        'composition',
        'width',
        'weight',
        'quality_grade',
        'stock_quantity',
        'unit',
        'unit_price',
        'cost_price',
        'reorder_level',
        'location',
        'status',
        'is_active',
    ];
}
