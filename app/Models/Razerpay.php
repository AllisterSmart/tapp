<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Razerpay extends Model
{
    use HasFactory;
    protected $table = 'razerpay';
    protected $guarded = ['id'];
}
