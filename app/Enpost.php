<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \InterventionImage;

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
    
    public function likeuser()
    {
        return $this->belongsToMany(User::class, 'likes', 'enpost_id', 'user_id')->withTimestamps();
    }
    
    //ある投稿が$user_idにいいねをされているかを判定
    public function is_likedby($user_id)
    {
        return $this->likeuser()->where('user_id', '=', $user_id)->exists();
    }
    
    //ある投稿が$user_idに添削されているかを判定
    public function is_correctedby()
    {
        $user=\Auth::user();
        return $this->corrections()->where('user_id','=',$user->id)->exists();
    }
    
}
