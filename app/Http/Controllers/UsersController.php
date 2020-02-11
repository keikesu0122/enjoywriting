<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use \InterventionImage;
use App\User;
use App\Enpost;

class UsersController extends Controller
{
    public function show($id)
    {
        $data=[];
        $user=User::find($id);
        $user->ImgResize(120);
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
            $enpost->ImgResize(120);
            $enposts[]=$enpost;
        }
        
        $data=[
          'user'=>$user,
          'enposts'=>$enposts,
        ];
        
        return view('users.showcorrections',$data);
    }
    
    public function edit()
    {
        $user=\Auth::user();
        
        return view('users.edit',[
            'user'=>$user
        ]);
    }
    
    public function update (UserRequest $request)
    {
        $user=\Auth::user();
        
        $filename="";
        if($request->selfimg!=null){
            $originalimage=$request->file('selfimg');
            if($user->selfimg!="default.jpg"){
                $filename=$user->selfimg;   
            }else{
                $filename=time().'.'.$originalimage->getClientOriginalExtension();
            }
            InterventionImage::make($originalimage)->save(storage_path().'/app/public/self_images/'.$filename);
        }else{
            if($user->selfimg!=null){
                $imgpath=storage_path().'/app/public/self_images'.$user->selfimg;
                \File::delete($imgpath);
            }
            $filename="default.jpg";
        }
        
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->introtext=$request->introtext;
        $user->selfimg=$filename;
        $user->save();
        
        return redirect('/');
    }
    
    public function destroy()
    {
        $user=\Auth::user();
        $user->delete();
        
        return redirect('/');
    }
    
    public function ranking()
    {
        $imgsize=100;
        
        $users_correction=User::withCount('corrections')->orderBy('corrections_count','desc')->get();
        foreach($users_correction as $user_correction){
            $user_correction->ImgResize($imgsize);
        }
        
        $users_enpost=User::withCount('enposts')->orderBy('enposts_count','desc')->get();
        foreach($users_enpost as $user_enpost){
            $user_enpost->ImgResize($imgsize);
        }
        
        $users_bc=User::withCount('corrections')
        ->orderBy('corrections_count','desc')
        ->whereHas('corrections', function($query){
            $query->where('bcflag',1);
        })
        ->get();
        foreach($users_bc as $user_bc){
            $user_bc->ImgResize($imgsize);
        }
        
        $data=[
            'users_correction'=>$users_correction,
            'users_enpost'=>$users_enpost,
            'users_bc'=>$users_bc,
        ];
        
        return view('users.ranking',$data);
    }
}
