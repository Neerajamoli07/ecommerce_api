<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id','address','title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
