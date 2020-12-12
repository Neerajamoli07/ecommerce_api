<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id','address','title','pin_code','line1_address','line2_address','landmark'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
