<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $table = 'invoices';
    protected $fillable = [
        'invoice_number',
        'customer_info_id',
        'sale_date',
        'total_amount',
        'discount_amount',
        'tax_amount',
        'final_amount',
        'payment_method',
        'payment_status',
        'notes',
        'user_id',
    ];
}
