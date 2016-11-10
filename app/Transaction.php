<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Notifiable;

    protected $table = 'transactions';

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    protected $fillable = [
        'id', 'name', 'number', 'balance', 'price', 'total', 'date', 'symbol', 'type',
    ];

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $guarded = array();


	 // public function user()
  //   {
  //       return $this->belongsTo('User');
  //   }

}