@if ($enpost->is_likedby(\Auth::user()->id))
    {!! Form::open(['route' => ['enposts.dislike', $enpost->id], 'method' => 'delete']) !!}
        {!! Form::submit('いいね!!', ['class' => "btn btn-danger btn-block"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['enposts.like', $enpost->id]]) !!}
        {!! Form::submit('いいね!!', ['class' => "btn btn-default btn-block"]) !!}
    {!! Form::close() !!}
@endif