<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enpost extends Model
{
    protected $fillable=['user_id', 'title', 'entext', 'jptext', 'tag', 'postimg', 'status'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
