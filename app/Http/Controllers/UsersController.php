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
    
    public function passwordedit()
    {
        $user=\Auth::user();
        
        return view('users.passwordedit',[
            'user'=>$user
        ]);
    }
    
    public function update (UserRequest $request)
    {
        $user=\Auth::user();
        
        $filename="";
        if($request->selfimg!=null){
            $selfimage=$request->file('selfimg');
            if($user->selfimg!="default.jpg"){
                \Storage::disk('s3')->delete('/self_images/'.$user->selfimg);  
            }
            $filename=time().'.'.$selfimage->getClientOriginalExtension();
            \Storage::disk('s3')->putFileAs('/self_images/',$selfimage, $filename,'public');
            $user->selfimg=$filename;
        }
        
        $user->name=$request->name;
        $user->email=$request->email;
        $user->introtext=$request->introtext;
        $user->save();
        
        return redirect('/')->with('flash_message', '会員情報の変更が完了しました。');
    }
    
    public function passwordupdate (Request $request)
    {
        
        $user=\Auth::user();
        
        $this->validate($request, [
            'oldpassword'=>'required',
            'password' => 'required|string|min:6|confirmed',    
        ]);
        
        if(!\Hash::check($request->oldpassword, $user->password)){
            return back()->with('error_message','現在のパスワードが違います');
        }else{
            $user->password=bcrypt($request->password);
            $user->save();
        }
        
        return redirect('/')->with('flash_message', 'パスワードの変更が完了しました。');
    }
    
    public function destroy()
    {
        $user=\Auth::user();
        \Storage::disk('s3')->delete('/self_images/'.$user->selfimg);
        $user->delete();
        
        return redirect('/');
    }
    
    public function ranking()
    {
            $users_correction=User::withCount('corrections')->orderBy('corrections_count','desc')->get();
            
            $users_enpost=User::withCount('enposts')->orderBy('enposts_count','desc')->get();
            
            $users_bc=User::withCount('corrections')
            ->orderBy('corrections_count','desc')
            ->whereHas('corrections', function($query){
                $query->where('bcflag',1);
            })
            ->get();
            
            $data=[
                'users_correction'=>$users_correction,
                'users_enpost'=>$users_enpost,
                'users_bc'=>$users_bc,
            ];
        
        return view('users.ranking',$data);
    }
}
