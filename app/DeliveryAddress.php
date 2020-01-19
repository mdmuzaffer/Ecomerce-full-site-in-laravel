<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
       protected $fillable = [
	   'user_id', 'user_email', 'name', 'address', 'mobile', 'pincode','country','state','city'

    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at',
    ];
}
