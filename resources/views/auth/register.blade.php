@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>会員登録</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post', 'files'=>true]) !!}
                {{csrf_field()}}
                <div class="form-group">
                    {!! Form::label('name', 'ユーザ名') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード（確認）') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                
                <div>
                    {!! Form::label('introtext', '自己紹介') !!}
                </div>
                <div>
                    {!! Form::textarea('introtext') !!}
                </div>
                
                 <div class="form-group mt-3">
                    {!! Form::label('selfimg', 'アバター画像') !!}
                    {!! Form::file('selfimg', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('会員登録', ['class' => 'btn btn-primary btn-block mb-4']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection