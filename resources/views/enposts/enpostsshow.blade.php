<h3>{{$enpost->title}}</h3>
<div class="row">
     <div class="col-sm-6">
        <h4 class="mb-2 text-muted">英文</h4>
        {{$enpost->entext}}
    </div>
    <div class="col-sm-6">
        <h4 class="mb-2 text-muted">和文</h4>
        {{$enpost->jptext}}
    </div>
</div>
<div class="row mt-2">
    <div class="col-sm-6">
        <h4 class="mb-2 text-muted">画像</h4>
        <img class="mr-2 rounded" src="{{ asset('/storage/post_images/'.$enpost->postimg) }}" alt="">
    </div>
    <div class="col-sm-6">
        <h4 class="mb-2 text-muted">タグ</h4>
        <ul>
        @foreach ($tags as $tag)
            <li style="display:inline" class="mr-2">{{$tag->tag}}</li>
        @endforeach
        </ul>
    </div>
</div>
