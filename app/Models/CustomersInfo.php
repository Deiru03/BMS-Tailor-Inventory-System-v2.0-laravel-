<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomersInfo extends Model
{
    use HasFactory;
    protected $table = 'customers_infos';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'sex',
        'notes',
        'customer_id',
        'purchased_amount',
        'amount_paid',
        'balance'
    ];
}
