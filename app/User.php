<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \InterventionImage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introtext', 'selfimg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function enposts()
    {
        return $this->hasMany(Enpost::class);
    }
    
    public function corrections()
    {
        return $this->hasMany(Correction::class);
    }
    
    public function likeenposts()
    {
        return $this->belongsToMany(Enpost::class, 'likes', 'user_id', 'enpost_id')->withTimestamps();
    }
    
    //画像サイズの変更
    public function ImgResize($size)
    {
        InterventionImage::make(storage_path().'/app/public/self_images/'.$this->selfimg)
        ->resize($size, null, function ($constraint) {$constraint->aspectRatio();})
        ->save(storage_path().'/app/public/self_images/'.$this->selfimg);
    }
}
