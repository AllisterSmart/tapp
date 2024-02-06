<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    
    protected $table = 'tournaments';

    protected $fillable = [
        'game_name',
        'title',
        'image',
        'map',
        'category',
        'game_mode',
        'entry_fees',
        'prize_pool',
        'per_kill',
        'from_bonus',
        'total_players',
        'start_rank_1',
        'start_rank_2',
        'amount',
        'from_schedule',
        'to_schedule',
        't_details'
    ];
}
