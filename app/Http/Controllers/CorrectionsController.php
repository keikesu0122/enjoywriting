<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CorrectionRequest;

use App\Enpost;
use App\Tag;
use App\Correction;

class CorrectionsController extends Controller
{
    public function correct($enpost_id)
    {
        
        $data=[];
        $correction = new Correction;
        $enpost=Enpost::find($enpost_id);
        $tags=Tag::where('enpost_id','=',$enpost_id)->get();
        
        $data=[
            'enpost'=>$enpost,
            'tags'=>$tags,
            'correction'=>$correction,
        ];
        
        return view('corrections.correct',$data);
    }
    
    public function uploadcorrection(CorrectionRequest $request, $enpost_id)
    {
        $correction= new Correction;
        $enpost=Enpost::find($enpost_id);
        $user=\Auth::user();
        
        //dd($user->name);
        
        $enpost->corrections()->create([
            'user_id'=>$user->id,
            'crtext'=>$request->crtext,
            'comment'=>$request->comment,
        ]);
        
        $tags=Tag::where('enpost_id'.'=',$enpost_id);
        $corrections=Correction::where('enpost_id','=', $enpost_id)->get();
        
        $data=[
            'enpost'=>$enpost,
            'tags'=>$tags,
            'corrections'=>$corrections,
        ];
        
        return view('enposts.show',$data);
    }
}
