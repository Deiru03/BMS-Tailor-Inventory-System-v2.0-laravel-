<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'sale_items';

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
        'status',
    ];
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
    
    /**
     * Get the invoice associated with this sale item through the sale.
     */
    public function invoiceSale()
    {
        return $this->hasOneThrough(
            InvoiceSale::class, // Final model
            Sale::class,        // Intermediate model
            'id',               // Foreign key on the sales table (intermediate)
            'sale_id',          // Foreign key on the invoice_sales table (final)
            'sale_id',          // Local key on the sale_items table
            'id'                // Local key on the sales table
        );
    }

    /**
     * Get the product associated with the sale item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function returnSales()
    {
        return $this->hasMany(ReturnSales::class, 'sale_item_id');
    }
}
