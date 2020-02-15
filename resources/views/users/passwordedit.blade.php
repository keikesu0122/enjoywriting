@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>パスワード変更</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => ['users.passwordupdate', \Auth::user()->id], 'method'=>'put']) !!}
                <div class="form-group">
                    {!! Form::label('oldpassword', '現在のパスワード') !!}
                    {!! Form::password('oldpassword', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', '新しいパスワード') !!}
                    {!! Form::password('password',['class' => 'form-control']) !!}
                </div>
    
                <div class="form-group">
                    {!! Form::label('password_confirmation', '新しいパスワード（確認）') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('送信', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
@endsection