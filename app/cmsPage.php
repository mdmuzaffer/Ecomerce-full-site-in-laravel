<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class cmsPage extends Model
{
	public $timestamps = false;
    protected $fillable = [
		'title', 'description', 'url','status',

    ];
  
}
