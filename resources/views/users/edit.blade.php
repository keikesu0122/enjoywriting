@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>会員情報変更</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(['route' => ['users.update', 'id'=>$user->id], 'files'=>true, 'method'=>'put'] ) !!}
            {{csrf_field()}}
            <div class="form-group">
                {!! Form::label('name', 'ユーザ名') !!}
                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'メールアドレス') !!}
                {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
            </div>
            
            <div>
              <ul style="list-style:none; padding: 0;">
                  <li>{!! Form::label('introtext', '自己紹介') !!}</li>
                  <li>{!! Form::textarea('introtext', $user->introtext) !!}</li>
              </ul>
            </div>
            
             <div>
               <ul style="list-style:none; padding: 0;">
                 <li>{!! Form::label('selfimg', 'アバター画像') !!}</li>
                 <li><img class="rounded img-fluid" src="{{\Storage::disk('s3')->url('self_images/'.$user->selfimg)}}" width="200" height="auto" alt=""></li>
                 <li>{!! Form::file('selfimg', ['class' => 'form-control']) !!}</li>
              </ul>  
             </div>
            
            {!! Form::submit('更新',['class' => 'btn btn-primary btn-block mb-4']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection