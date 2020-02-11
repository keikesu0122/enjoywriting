<div class="form-inline mt-2">
    @if(Auth::user()->id==$enpost->user->id)
        @if($enpost->status==0)
            {!! link_to_route('enposts.edit', '編集', ['id'=>$enpost->id], ['class' => 'btn btn-primary mr-2']) !!}
        @endif
        {!! Form::open(['route' => ['enposts.destroy', $enpost->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
        {!! Form::close() !!}
    @else
        @if($enpost->status==0)
            {!! link_to_route('corrections.correct', '添削', ['user_id'=>$enpost->user_id, 'enpost_id'=>$enpost->id], ['class' => 'btn btn-secondary mr-2']) !!}
        @endif
    @endif
</div>