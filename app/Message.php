<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'sender','receiver','message','room_code'
    ];

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver', 'id');
    }

}
