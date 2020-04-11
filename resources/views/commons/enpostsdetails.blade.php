<h3>{{$enpost->title}}</h3>
<div class="row">
     <div class="col-sm-5">
        <h4 class="mb-2 text-muted">英文</h4>
        {{$enpost->entext}}
    </div>
    <div class="col-sm-5">
        <h4 class="mb-2 text-muted">和文</h4>
        {{$enpost->jptext}}
    </div>
    <div class="col-sm-2">
        <div id="commons-enpostsdetails-like-button">
            <like-button :enpost_id={{$enpost->id}}></like-button>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-sm-5">
        <h4 class="mb-2 text-muted">画像</h4>
        <img class="mr-2 rounded" src="{{\Storage::disk('s3')->url('post_images/'.$enpost->postimg)}}" width="150", height="auto" alt="">
    </div>
    <div class="col-sm-5">
        <h4 class="mb-2 text-muted">タグ</h4>
        <ul>
        @foreach ($tags as $tag)
            <li style="display:inline" class="mr-2">{{$tag->tag}}</li>
        @endforeach
        </ul>
    </div>
</div>
