<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $fillable = [
       'parent_id', 'name', 'description', 'url','status',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	public function products(){
		return $this->hasMany(Products::class);
	}
	
	public function categories(){
		return $this->hasMany('App\Category','parent_id');
	}
}
