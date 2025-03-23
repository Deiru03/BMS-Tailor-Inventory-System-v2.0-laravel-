<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerMeasurements extends Model
{
    //
    protected $table = 'customer_measurements';

    protected $fillable = [
        'customer_info_id',
        'height',
        'weight',
        'neck',
        'shoulder',
        'chest',
        'bust',
        'waist',
        'hip',
        'sleeve_length',
        'bicep',
        'wrist',
        'back_width',
        'shirt_length',
        'armhole_depth',
        'thigh',
        'knee',
        'calf',
        'ankle',
        'inseam',
        'outseam',
        'crotch_depth',
        'front_rise',
        'back_rise',
        'pants_length',
        'jacket_length',
        'collar',
        'shorts_length',
    ];
}
