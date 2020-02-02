<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Enpost;

class UsersController extends Controller
{
    public function show($id)
    {
        $data=[];
        $user=User::find($id);
        $enposts=$user->enposts()->get();
        
        $data=[
          'user'=>$user,
          'enposts'=>$enposts,
        ];
        
        return view('users.show', $data);
        
    }
    
    public function showcorrections($id)
    {
        $data=[];
        $enposts=[];
        $user=User::find($id);
        $corrections=$user->corrections()->get();
        foreach($corrections as $correction){
            $enpost=Enpost::where('id','=', $correction->enpost_id)->first();
            $enposts[]=$enpost;
            //dd($enpost->user->name);
        }
        
        $data=[
          'user'=>$user,
          'enposts'=>$enposts,
        ];
        
        return view('users.showcorrections',$data);
    }
}
