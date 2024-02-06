<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'referal_code',
        'user_referal_code',
        'name',
        'email',
        'mobile',
        'address',
        'otp',
        'otp_expires_at',
        'add_balance',
        'total_balance',
        'transition_id',
        'withdraw_amount',
        'withdraw_time',
        'role',
        'favoriteColor',
        'picture',
        'user_id',
        'razorpay_order_id',
        'amount',
        'status',
    ];
    
    public function addBalance($amount)
    {
        $this->add_balance += $amount;
        $this->total_balance += $amount;
        $this->save();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getPictureAttribute($value){
        if($value){
            return asset('users/images/'.$value);
        }else{
            return asset('users/images/no-image.png');
        }
    }
}
