@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <ul class="list-unstyled">
            @foreach ($enposts as $enpost)
                <li class="media mb-3">
                    <img class="mr-2 rounded" src="{{ asset('/storage/self_images/'.$enpost->user->selfimg) }}" alt="">
                    <div class="media-body">
                        <div>
                            <a href="#" >{{$enpost->user->name}}</a><br>
                            <a href="#">{{$enpost->title}}</a><br>
                            posted at {{ $enpost->created_at }}
                        </div>
                        <div style="display:inline">
                            @if(Auth::user()->id==$enpost->user->id)
                                <a class="btn btn-primary" href="#">編集</a>
                                <a class="btn btn-danger" href="#">削除</a>
                            @else
                                <a class="btn btn-secondary" href="#">添削</a>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $enposts->links('pagination::bootstrap-4') }}
    @else
         <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Enjoywriting</h1>
                {!! link_to_route('signup.get', '会員登録はこちら!!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection