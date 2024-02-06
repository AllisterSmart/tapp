<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;
    protected $table = 'players';
    protected $fillable = [
        'player_name',
        'player_id',
        'category',
        'image',
        'category_id',
    ];
}