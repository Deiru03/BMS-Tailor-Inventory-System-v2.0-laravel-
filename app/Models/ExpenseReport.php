<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseReport extends Model
{
    protected $table = 'expense_reports';

    protected $fillable = [
        'material_code',
        'name',
        'cost_price',
        'supplier_name',
        'supplier_type',
        'expense_date',
    ];
}