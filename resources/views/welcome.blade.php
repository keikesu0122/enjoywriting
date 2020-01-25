@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Enjoywriting</h1>
            {!! link_to_route('signup.get', '会員登録はこちら!!', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endsection