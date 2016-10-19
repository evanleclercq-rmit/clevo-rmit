<?php

 namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
		'location', 'bio',
		'twitter_username', 'balance'
	];

	public function user()
	{
		return $this->belongsTo('User');
	}

} 

