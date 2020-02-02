<?php

namespace App\Http\Controllers;

use \InterventionImage;
use Illuminate\Http\Request;
use App\Http\Requests\EnpostRequest;

use App\Enpost;
use App\Tag;
use App\Correction;
use App\User;

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
        
        /*return view('enposts.create',[
            'enpost'=> $enpost,    
        ]);*/
        return view('enposts.create');
    }
    
    public function store(EnpostRequest $request)
    {
        
        $filename="";
        $request=request();
        if($request->postimg!=null){
            $originalimage=$request->file('postimg');
            $filename=time().'.'.$originalimage->getClientOriginalExtension();
            $postimage=InterventionImage::make($originalimage)->resize(150, null, function ($constraint) {$constraint->aspectRatio();});
            $path=$postimage->save(storage_path().'/app/public/post_images/'.$filename);
        }
        
        $request->user()->enposts()->create([
           'title'=>$request->title,
           'entext'=>$request->entext,
           'jptext'=>$request->jptext,
           //'tag'=>$request->tag,
           'postimg'=>$filename,
           'status'=>0,
        ]);
        
        if($request->tag!=null){
            $max_enpost_id=Enpost::max('id');
            $enpost=Enpost::find($max_enpost_id);
            $combinedtags=$request->tag;
            $tags=explode(",",$combinedtags);
            
            foreach ($tags as $tag){
                $enpost->tags()->create([
                   'tag'=>$tag,
                ]);
            }
        }
        
        return back();
    }
    
    public function edit($id)
    {
        
        $enpost=Enpost::find($id);
        
        //dd($enpost->id);
        
        return view('enposts.edit',[
            'enpost'=>$enpost,    
        ]);
    }
    
    public function update(EnpostRequest $request, $id)
    {
        $enpost=Enpost::find($id);
        
        $filename="";
        if($request->postimg!=null){
            $originalimage=$request->file('postimg');
            if($enpost->postimg!=null){
                $filename=$enpost->postimg;   
            }else{
                $filename=time().'.'.$originalimage->getClientOriginalExtension();
            }
            $postimage=InterventionImage::make($originalimage)->resize(150, null, function ($constraint) {$constraint->aspectRatio();});
            $postimage->save(storage_path().'/app/public/post_images/'.$filename);
        }else{
            if($enpost->postimg!=null){
                $imgpath=storage_path().'/app/public/post_images'.$enpost->postimg;
                \File::delete($imgpath);
            }
        }
        
        $enpost->title=$request->title;
        $enpost->entext=$request->entext;
        $enpost->jptext=$request->jptext;
        $enpost->postimg=$filename;
        $enpost->save();
        
        $combinedtags=$request->tag;
        $newtags=explode(",",$combinedtags);
        
        $oldtags=Tag::where('enpost_id','=',$enpost->id)->get();
        foreach($oldtags as $oldtag){
            $oldtag->delete();
        }
        
        
        foreach ($newtags as $newtag){
            $enpost->tags()->create([
               'tag'=>$newtag,
            ]);
        }
        
        return back();
    }
    
    public function destroy($id)
    {
        $enpost = Enpost::find($id);
        
        //dd($enpost->id);

        if (\Auth::id() === $enpost->user_id) {
            $enpost->delete();
        }

        return redirect('/');
    }
    
    public function show($id)
    {
        $data=[];
        $enpost=Enpost::find($id);
        //$user=User::find($enpost->user_id);
        $tags=Tag::where('enpost_id','=',$id)->get();
        $corrections=Correction::where('enpost_id','=',$enpost->id)->get();
        
        $data=[
            //'users'=>$users,
            'enpost'=>$enpost,
            'tags'=>$tags,
            'corrections'=>$corrections,
        ];
        
        return view('enposts.show',$data);
    }
}
