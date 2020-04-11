<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enpost;

class EnpostLikeController extends Controller
{
    //いいねを追加・消去
    public function addlike(Request $request)
    {
        $enpost=Enpost::find($request->enpost_id);
        $user=\Auth::user();
        
        
        if($enpost->is_likedby($user->id)!=True)
        {
            $res=true;
            $enpost->likeuser()->attach($user->id);
            $like_count=$enpost->likeuser()->count();
        }else{
            $res=false;
            $enpost->likeuser()->detach($user->id);
            $like_count=$enpost->likeuser()->count();
        }
        
        return response()->json(['res'=>$res, 'like_count'=>$like_count]);
    }
    
    //いいねを取得
    public function getlike(Request $request)
    {
        $enpost=Enpost::find($request->enpost_id);
        $user=\Auth::user();
        
        
        if($enpost->is_likedby($user->id)!=True)
        {
            $res=false;
            $like_count=$enpost->likeuser()->count();
        }else{
            $res=true;
            $like_count=$enpost->likeuser()->count();
        }
        
        return response()->json(['res'=>$res, 'like_count'=>$like_count]);
    }
}
