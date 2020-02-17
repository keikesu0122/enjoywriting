<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CorrectionRequest;

use App\Enpost;
use App\Tag;
use App\Correction;

class CorrectionsController extends Controller
{
    //添削する
    public function correct($enpost_id)
    {
        $data=[];
        $user=\Auth::user();
        $enpost=Enpost::find($enpost_id);
        if($enpost->is_correctedby()){
            $correction_id=$enpost->corrections()->where('user_id','=',$user->id)->first()->id;
            $correction=Correction::find($correction_id);
            if(\Auth::id()!=$correction->user_id | \Auth::id()==$enpost->user_id){
                return redirect('/');
            }
        }else{
            $correction = new Correction;
            if(\Auth::id()==$enpost->user_id){
                return redirect('/');
            }
        }
    
        $tags=Tag::where('enpost_id','=',$enpost_id)->get();
        
        $data=[
            'enpost'=>$enpost,
            'tags'=>$tags,
            'correction'=>$correction,
        ];
        
        return view('corrections.correct',$data)->with('flash_message', '添削を投稿しました。');
    }
    
    public function uploadcorrection(CorrectionRequest $request, $enpost_id)
    {
        $correction= new Correction;
        $enpost=Enpost::find($enpost_id);
        $user=\Auth::user();
        
        $enpost->corrections()->create([
            'user_id'=>$user->id,
            'crtext'=>$request->crtext,
            'comment'=>$request->comment,
            'bcflag'=>false,
        ]);
        
        $tags=Tag::where('enpost_id'.'=',$enpost_id);
        $corrections=Correction::where('enpost_id','=', $enpost_id)->get();
        $bestcorrection=null;
        
        /*$data=[
            'enpost'=>$enpost,
            'tags'=>$tags,
            'corrections'=>$corrections,
            'bestcorrection'=>$bestcorrection,
        ];*/
        
        //return view('enposts.show',$data);
        return redirect('/');
    }
    
    //添削を編集
    public function updatecorrection(CorrectionRequest $request, $enpost_id)
    {
        $user=\Auth::user();
        $correction= Correction::where('enpost_id','=',$enpost_id)->where('user_id','=',$user->id)->first();
        $enpost=Enpost::find($enpost_id);
        
        $correction->crtext=$request->crtext;
        $correction->comment=$request->comment;
        $correction->save();
        
        $tags=Tag::where('enpost_id'.'=',$enpost_id);
        $corrections=Correction::where('enpost_id','=', $enpost_id)->get();
        $bestcorrection=null;
        
        return redirect('/')->with('flash_message', '添削を編集しました。');
    }
    
    //添削を削除
    public function destroy($id)
    {
        $correction = Correction::find($id);

        if (\Auth::id() === $correction->user_id) {
            $correction->delete();
        }

        return redirect('/')->with('flash_message', '添削を削除しました。');
    }
    
    //ベスト添削が選ばれた時にフラグやステータスを変更
    public function bestcorrection($correction_id)
    {
        $correction=Correction::find($correction_id);
        $correction->bcflag=true;
        $correction->save();
        
        
        $enpost=Enpost::find($correction->enpost()->first()->id);
        $enpost->status=1;
        $enpost->save();
        
        return back();
    }
}
