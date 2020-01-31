@extends('layouts.app')

@section('content')
    <div class="row">
        @if(Auth::check())
            <div class="col-sm-6">
                {!! Form::model($enpost, ['route' => ['enposts.update', $enpost->id], 'files'=>true, 'method'=>'put'] ) !!}
                    {{csrf_field()}}
                    <div class="form-group form-inline">
                        {!! Form::label('title', 'タイトル') !!}
                        {!! Form::text('title', old('title', $enpost->title), ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-inline">
                        {!! Form::label('entext', '英文') !!}
                        {!! Form::textarea('entext', old('entext', $enpost->entext)) !!}
                    </div>
    
                    <div class="form-inline">
                        {!! Form::label('jptext', '和文') !!}
                        {!! Form::textarea('jptext', old('jptext', $enpost->jptext)) !!}
                    </div>
    
                    <div class="form-group mt-3 form-inline">
                        {!! Form::label('postimg', '画像') !!}
                        {!! Form::file('postimg', ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group form-inline">
                        {!! Form::label('tag', 'タグ') !!}
                        {!! Form::text('tag',old('tag',$enpost->tag), ['class' => 'form-control']) !!}
                    </div>
                    
                    {!! Form::submit('投稿する', ['class' => 'btn btn-primary btn-block mb-4']) !!}
                {!! Form::close() !!}
                <a class="btn btn-danger btn-block" href="#">キャンセル</a>
            </div>
        @endif
    </div>
@endsection