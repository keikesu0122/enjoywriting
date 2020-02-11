<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        <img class="rounded img-fluid" src="{{ asset('/storage/self_images/'.$user->selfimg) }}" alt="">
    </div>
    <div class="card-body">
        {{$user->introtext}}
    </div>
    @if(Auth::user()->id==$user->id)
        <div class="form-inline mt-2">
            {!! link_to_route('users.edit', '編集', ['id'=>$user->id], ['class' => 'btn btn-primary mr-2']) !!}
            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('退会', ['class' => 'btn btn-danger btn-sm']) !!}
            {!! Form::close() !!}
        </div>
    @endif
</div>