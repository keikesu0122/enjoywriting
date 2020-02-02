@extends('layouts.app')

@section('content')
    @if(Auth::check())
        @include('commons.enpostsindex', ['enposts'=>$enposts])
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