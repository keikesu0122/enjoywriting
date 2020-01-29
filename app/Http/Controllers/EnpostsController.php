<?php

namespace App\Http\Controllers;

use \InterventionImage;
use Illuminate\Http\Request;
use App\Http\Requests\EnpostRequest;

use App\Enpost;

class EnpostsController extends Controller
{
    public function index()
    {
        $data=[];
        if(\Auth::check()){
            $enposts=Enpost::orderBy('created_at','desc')->paginate(10);
            $data=[
              'enposts'=>$enposts,  
            ];
        }
        
        return view('enposts.index',$data);
    }
    
    public function create()
    {
        $enpost = new Enpost;
        
        return view('enposts.create',[
            'enpost'=> $enpost,    
        ]);
        //return view('enposts.create');
    }
    
    public function store(EnpostRequest $request)
    {
        
        $filename="";
        $request=request();
        if(!empty($request->postimg)){
            $originalimage=$request->file('postimg');
            $filename=time().'.'.$originalimage->getClientOriginalExtension();
            $postimage=InterventionImage::make($originalimage)->resize(150, null, function ($constraint) {$constraint->aspectRatio();});
            $path=$postimage->save(storage_path().'/app/public/self_images/'.$filename);
        }
        
        $request->user()->enposts()->create([
           'title'=>$request->title,
           'entext'=>$request->entext,
           'jptext'=>$request->jptext,
           'tag'=>$request->tag,
           'postimg'=>$filename,
           'status'=>0,
        ]);
        
        return back();
    }
}
