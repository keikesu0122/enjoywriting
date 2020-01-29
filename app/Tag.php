<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['enpost_id', 'tag'];
    
    public function enpost()
    {
        return $this->belongsTo(Enpost::class);
    }
}
