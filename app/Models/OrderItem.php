<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'product_name',
        'product_image',
        'product_price',
        'product_quantity'

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function users()
    {
        return $this->hasOne('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

}