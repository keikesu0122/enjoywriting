 <ul class="list-unstyled" id="commons-enpostsindex" @if(Request::is('/') or Request::is('enposts/*')) style="border-style: none;" @endif>
    @foreach ($enposts as $enpost)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{\Storage::disk('s3')->url('self_images/'.$enpost->user->selfimg)}}" width="130" height="auto" alt="">
            <div class="media-body">
                <div>
                    <a href="{{ route('users.show', ['id' => $enpost->user->id]) }}">{{$enpost->user->name}}</a><br>
                    <a href="{{ route('enposts.show', ['id' => $enpost->id]) }}">{{$enpost->title}}</a>
                    posted at {{ $enpost->created_at }}
                </div>
                @include('commons.buttons',['enpost'=>$enpost])
            </div>
        </li>
    @endforeach
</ul>
