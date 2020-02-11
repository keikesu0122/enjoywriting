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
    //トップページで投稿一覧を表示
    public function index()
    {
        $data=[];
        if(\Auth::check()){
            $enposts=Enpost::orderBy('created_at','desc')->paginate(10);
            
            foreach ($enposts as $enpost){
                $enpost->user()->first()->ImgResize(120);
            }
            
            $data=[
              'enposts'=>$enposts,  
            ];
        }
        
        return view('enposts.index',$data);
    }
    
    //投稿をする
    public function create()
    {
        $enpost = new Enpost;
        
        return view('enposts.create');
    }
    
    public function store(EnpostRequest $request)
    {
        
        //画像の保存処理（storageの下に保存）
        $filename="";
        $request=request();
        if($request->postimg!=null){
            $originalimage=$request->file('postimg');
            $filename=time().'.'.$originalimage->getClientOriginalExtension();
            $postimage=InterventionImage::make($originalimage)->save(storage_path().'/app/public/post_images/'.$filename);
        }
        
        $request->user()->enposts()->create([
           'title'=>$request->title,
           'entext'=>$request->entext,
           'jptext'=>$request->jptext,
           'postimg'=>$filename,
           'status'=>0,
        ]);
        
        //タグは1単語ずつ分割して保存
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
    
    //投稿の編集
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
            $postimage=InterventionImage::make($originalimage)->save(storage_path().'/app/public/post_images/'.$filename);
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
    
    //投稿を削除
    public function destroy($id)
    {
        $enpost = Enpost::find($id);

        if (\Auth::id() === $enpost->user_id) {
            $enpost->delete();
        }

        return redirect('/');
    }
    
    //投稿の詳細を表示
    public function show($id)
    {
        $data=[];
        $enpost=Enpost::find($id);
        if($enpost->postimg!=""){
            $enpost->ImgResize(200);
        }
        $tags=Tag::where('enpost_id','=',$id)->get();
        $corrections=Correction::where('enpost_id','=',$enpost->id)->get();
        $bestcorrection=Correction::where('enpost_id','=',$id)->where('bcflag','=',1)->first();
        
        
        $data=[
            'enpost'=>$enpost,
            'tags'=>$tags,
            'corrections'=>$corrections,
            'bestcorrection'=>$bestcorrection,
        ];
        
        return view('enposts.show',$data);
    }
}
