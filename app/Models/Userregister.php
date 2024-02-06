<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userregister extends Model
{
    use HasFactory;
     protected $table = 'userregister';
    protected $fillable = ['name', 'user_id', 'state', 'mobile_email', 'dob', 'referalcode'];
}

