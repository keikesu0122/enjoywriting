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
            $users=User::select('id', 'name')->get()->pluck('name', 'id');
            
            
            $data=[
              'enposts'=>$enposts,
              'users'=>$users
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
        
        //画像の保存処理（S3に保存）
        $filename="";
        if($request->postimg!=null){
            $postimage=$request->file('postimg');
            $filename=time().'.'.$postimage->getClientOriginalExtension();
             \Storage::disk('s3')->putFileAs('/post_images/',$postimage, $filename,'public');
        }
        
        
        \DB::transaction(function () use ($request, $filename){
            $request->user()->enposts()->create([
               'title'=>$request->title,
               'entext'=>$request->entext,
               'jptext'=>$request->jptext,
               'postimg'=>$filename,
               'status'=>\Constant::open,
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
        });
        
        return redirect('/')->with('flash_message', '投稿が完了しました。');
    }
    
    //投稿の編集
    public function edit($id)
    {
        
        $enpost=Enpost::find($id);
        $tags=$enpost->tags()->get();
        
        $i=0;
        $oldtag="";
        
        foreach($tags as $tag){
            if($oldtag==""){
                $oldtag=$tag->tag;
            }else{
                $oldtag=$oldtag.",".$tag->tag;
            }
        }
        
        if(\Auth::id()==$enpost->user_id){
            return view('enposts.edit',[
                'enpost'=>$enpost,    
                'oldtag'=>$oldtag
            ]);
        }else{
            return redirect('/');
        }
    }
    
    public function update(EnpostRequest $request, $id)
    {
        $enpost=Enpost::find($id);
        
        $filename="";
        if($request->postimg!=null){
            $postimage=$request->file('postimg');
            if($enpost->postimg!=null){
                \Storage::disk('s3')->delete('/post_images/'.$enpost->postimg);
            }
            $filename=time().'.'.$postimage->getClientOriginalExtension();
             \Storage::disk('s3')->putFileAs('/post_images/',$postimage, $filename,'public');
        }else{
            if($enpost->postimg!=null){
                \Storage::disk('s3')->delete('/post_images/'.$enpost->postimg);
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
        
        return redirect('/')->with('flash_message', '編集が完了しました。');
    }
    
    //投稿を削除
    public function destroy($id)
    {
        $enpost = Enpost::find($id);

        if (\Auth::id() === $enpost->user_id) {
            \Storage::disk('s3')->delete('/post_images/'.$enpost->postimg);
            $enpost->delete();
        }

        return redirect('/')->with('flash_message', '削除が完了しました。');
    }
    
    //投稿の詳細を表示
    public function show($id)
    {
        $data=[];
        $enpost=Enpost::find($id);
        $tags=Tag::where('enpost_id','=',$id)->get();
        $corrections=Correction::where('enpost_id','=',$enpost->id)->get();
        $bestcorrection=Correction::where('enpost_id','=',$id)->where('bcflag','=',1)->first();
        $likes=$enpost->likeuser()->count();
        
        $data=[
            'enpost'=>$enpost,
            'tags'=>$tags,
            'corrections'=>$corrections,
            'bestcorrection'=>$bestcorrection,
            'likes'=>$likes,
        ];
        
        return view('enposts.show',$data);
    }
    
    //検索機能
    public function search(Request $request)
    {
        
        $query=Enpost::query();
        $title=$request->title;
        $entext=$request->entext;
        $tagword=$request->tag;
        $tags=Tag::where('tag',$tagword)->get();
        
        if(!empty($request->user)){
            $query->where('user_id',$request->user)->get();
        }
        
        if(!empty($title)){
            $query->where('title', 'like', '%'.$title.'%')->get();
        }
        
        if(!empty($entext)){
            $query->where('entext', 'like', '%'.$entext.'%')->get();
        }
        
        if(!empty($tagword)){
            foreach($tags as $tag){
                $enpost_id=$tag->enpost()->first()->id;
                $query->where('id', $enpost_id)->get();
            }
        }
        
        if($request->correction==1){
            $query->where('status',\Constant::open)->where('user_id','!=',\Auth::user()->id)->get();
        }
        
        
        
        switch($request->sort){
            case 0:
                $enposts=$query->orderBy('created_at','desc')->paginate(10);
                break;
            case 1:
                $enposts=$query->orderBy('created_at','asc')->paginate(10);
                break;
            case 2:
                $enposts = $query->withCount('corrections')->orderBy('corrections_count','desc')->paginate(10);
                break;
            case 3:
                $enposts = $query->withCount('corrections')->orderBy('corrections_count','asc')->paginate(10);
                break;
            case 4:
                $enposts = $query->withCount('likeuser')->orderBy('likeuser_count','desc')->paginate(10);
                break;
            case 5:
                $enposts = $query->withCount('likeuser')->orderBy('likeuser_count','asc')->paginate(10);
                break;
        }
        
        
        
        $users=User::select('id', 'name')->get()->pluck('name', 'id');
        
        return view('enposts.index',[
            'enposts'=>$enposts,
            'users'=>$users
        ]);
        
    }
}
