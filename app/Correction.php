<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correction extends Model
{
    protected $fillable=['user_id', 'enpost_id', 'crtext', 'comment', 'bcflag'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function enpost()
    {
        return $this->belongsTo(Enpost::class);
    }
}
