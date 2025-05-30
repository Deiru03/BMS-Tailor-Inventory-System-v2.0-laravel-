<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceReport extends Model
{
    protected $table = 'invoice_reports';

    protected $fillable = [
        'invoice_number',
        'sale_id',
        'customer_name',
        'total_amount',
        'amount_paid',
        'balance',
        'issued_at',
        'status',
    ];
}