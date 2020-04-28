<h3 class="commons-enpostsdetails-title">{{$enpost->title}}</h3>
<div class="commons-enpostsdetails-container">
  <div class="commons-enpostsdetails-upper">
     <div class="commons-enpostsdetails-entext">
       <h4 class="commons-enpostsdetails-entext-label">英文</h4>
       <div class="commons-enpostsdetails-entext-text">{{$enpost->entext}}</div>
     </div>
     <div class="commons-enpostsdetails-jptext">
        <h4 class="commons-enpostsdetails-jptext-label">和文</h4>
        <div class="commons-enpostsdetails-jptext-text">{{$enpost->jptext}}</div>
     </div>
  </div>
  <div class="commons-enpostsdetails-lower">
    <div class="commons-enpostsdetails-postimg">
      <h4 class="commons-enpostsdetails-postimg-label">画像</h4>
      <img class="rounded" src="{{\Storage::disk('s3')->url('post_images/'.$enpost->postimg)}}" width="150", height="auto" alt="">
    </div>
    <div class="commons-enpostsdetails-tag">
      <h4 class="commons-enpostsdetails-tag-label">タグ</h4>
      <ul>
        @foreach ($tags as $tag)
          <li>{{$tag->tag}}</li>
        @endforeach
       </ul>
    </div>
  </div>
  <div id="commons-enpostsdetails-like-button">
    <like-button :enpost_id={{$enpost->id}}></like-button>
  </div>
</div>
