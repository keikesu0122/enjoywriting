<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enpost;

class EnpostLikeController extends Controller
{
    //いいねをする
    public function store($enpost_id)
    {
        $enpost=Enpost::find($enpost_id);
        $user=\Auth::user();
        
        
        if($enpost->is_likedby($user->id)!=True)
        {
            $enpost->users()->attach($user->id);
        }
        
        return back();
    }
    
    //いいねを消す
    public function destroy($enpost_id)
    {
        $enpost=Enpost::find($enpost_id);
        $user=\Auth::user();
        
        if($enpost->is_likedby($user->id))
        {
            $enpost->users()->detach($user->id);
        }
        
        return back();
    }
}
