 <ul class="list-unstyled">
    @foreach ($enposts as $enpost)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ asset('/storage/self_images/'.$enpost->user->selfimg) }}" alt="">
            <div class="media-body">
                <div>
                    <a href="{{ route('users.show', ['id' => $enpost->user->id]) }}">{{$enpost->user->name}}</a><br>
                    <a href="{{ route('enposts.show', ['id' => $enpost->id]) }}">{{$enpost->title}}</a>
                    posted at {{ $enpost->created_at }}
                </div>
                <div class="form-inline mt-2">
                    @if(Auth::user()->id==$enpost->user->id)
                        {!! link_to_route('enposts.edit', '編集', ['id'=>$enpost->id], ['class' => 'btn btn-primary mr-2']) !!}
                        {!! Form::open(['route' => ['enposts.destroy', $enpost->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @else
                        {!! link_to_route('corrections.correct', '添削', ['user_id'=>$enpost->user_id, 'enpost_id'=>$enpost->id], ['class' => 'btn btn-secondary mr-2']) !!}
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>