<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'queues';
    public $timestamps = true;
    protected $guarded = [
    	'id',
    	'created_at',
    	'updated_at'
 	];

 	public function user()
  	{
    	return $this->belongsTo('App\User');
  	}
}
