<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    protected $fillable = [
	 'product_id', 'sku', 'size', 'price','stock',

    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token','created_at','updated_at',
    ];
}
