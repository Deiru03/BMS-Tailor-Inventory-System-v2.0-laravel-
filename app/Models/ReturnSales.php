<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnSales extends Model
{
    
    protected $table = 'return_sales';

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'reason',
        'processed_at',
        'status',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
