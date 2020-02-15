@extends('layouts.app')

@section('content')
    <div class="row">
        @if(Auth::check())
            <div class="col-sm-6">
                {!! Form::open(['route' => ['enposts.update', $enpost->id], 'files'=>true, 'method'=>'put'] ) !!}
                    {{csrf_field()}}
                    <div class="form-group form-inline">
                        {!! Form::label('title', 'タイトル') !!}
                        {!! Form::text('title', old('title', $enpost->title), ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-inline mb-3">
                        {!! Form::label('entext', '英文') !!}
                        {!! Form::textarea('entext', old('entext', $enpost->entext)) !!}
                    </div>
    
                    <div class="form-inline mb-3">
                        {!! Form::label('jptext', '和文') !!}
                        {!! Form::textarea('jptext', old('jptext', $enpost->jptext)) !!}
                    </div>
                    
                    <div>
                       <ul style="list-style:none; padding: 0;">
                         <li class="mb-1">{!! Form::label('postimg', '画像') !!}</li>
                         <li><img class="rounded img-fluid" src="{{\Storage::disk('s3')->url('post_images/'.$enpost->postimg)}}" width="200" height="auto" alt=""></li>
                         <li class="mt-1">{!! Form::file('postimg', ['class' => 'form-control']) !!}</li>
                      </ul>  
                     </div>
    
                    <div class="form-group form-inline">
                        {!! Form::label('tag', 'タグ') !!}
                        {!! Form::text('tag',old('tag',$oldtag), ['class' => 'form-control']) !!}
                        <label>複数のタグを入力する場合には各タグをカンマで区切ってください。</label>
                    </div>
                    
                    {!! Form::submit('投稿する', ['class' => 'btn btn-primary btn-block mb-4']) !!}
                {!! Form::close() !!}
            </div>
        @endif
    </div>
@endsection