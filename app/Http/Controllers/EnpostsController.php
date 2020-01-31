<?php

namespace App\Http\Controllers;

use \InterventionImage;
use Illuminate\Http\Request;
use App\Http\Requests\EnpostRequest;

use App\Enpost;
use App\Tag;

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
        if($request->postimg!=null){
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
        
        $enpost = new Enpost;
        $max_enpost_id=Enpost::max('id');
        $enpost=Enpost::find($max_enpost_id);
        $combinedtags=$enpost->tag;
        $tags=explode(",",$combinedtags);
        
        foreach ($tags as $tag){
            $enpost->tags()->create([
               'enpost_id'=>$enpost->id,
               'tag'=>$tag,
            ]);
        }
        
        return back();
    }
    
    public function edit($id)
    {
        $enpost=Enpost::find($id);
        
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
            $path=$postimage->save(storage_path().'/app/public/self_images/'.$filename);
        }else{
            if($enpost->postimg!=null){
                $imgpath=storage_path().'/app/public/post_images'.$enpost->postimg;
                \File::delete($imgpath);
            }
        }
        
        $enpost->title=$request->title;
        $enpost->entext=$request->entext;
        $enpost->jptext=$request->jptext;
        $enpost->tag=$request->tag;
        $enpost->postimg=$filename;
        $enpost->save();
        
        
        //dd($enpost->id);
        
        $combinedtags=$enpost->tag;
        $newtags=explode(",",$combinedtags);
        
        $oldtags=Tag::where('enpost_id','=',$enpost->id)->get();
        //dd($oldtags);
        foreach($oldtags as $oldtag){
            //dd($oldtag->tag);
            $oldtag->delete();
        }
        
        foreach ($newtags as $newtag){
            $enpost->tags()->create([
               'enpost_id'=>$enpost->id,
               'tag'=>$newtag,
            ]);
        }
        /*$count_tags=$enpost->tags()->count();
        $i=0;
        $change_tags=[];
        $add_tags=[];
        
        /*foreach($tags as $separatedtag){
            if($i<$count_tags){
                $change_tags[]=$separatedtag;
            }else{
                $add_tags[]=$separatedtag;
            }
            $i++;
        }
        
        $tagclasses = Tag::where('enpost_id', $enpost->id);
        foreach (array_map($change_tags, $tagclasses) as [$eachtag, $eachtagclass]){
                $eachtagclass->tag=$eachtag;
                $eachtagclass->save();
        }
        
        foreach($add_tags as $eachtag){
                $enpost->tags()->create([
               'enpost_id'=>$enpost->id,
               'tag'=>$eachtag,
               ]);
        }*/
        
        return back();
    }
}
