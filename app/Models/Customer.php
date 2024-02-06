<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer_information';
    protected $fillable = [
        'customer_name',
        'customer_address',
        'discreption',
        'customer_mobile',
        'customer_email',
        'project_name',
        'project_price',
        'p_amount',
        'p2_amount',
        'p3_amount',
        'p4_amount',
        'd_amount',
        'd2_amount',
        'd3_amount',
        'd4_amount',
        'date',
        'date2',
        'date3',
        'date4',
    ];
}
