<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thator extends Model
{
    use HasFactory;
    protected $table = 'thator';
    protected $fillable = [
        'name',
        'location',
        'image',
    ];
}