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
    
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    
    public function corrections()
    {
        return $this->hasMany(Correction::class);
    }
}
