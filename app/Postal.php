<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postal extends Model
{
    protected $fillable = [ 'place_name', 'pin_code','distance','deliver_cost'];
}
