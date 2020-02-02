@extends('layouts.app')

@section('content')
    @include('enposts.enpostsshow', ['enpost'=>$enpost, 'tags'=>$tags])
    @if(Auth::check())
        <div class="col-sm-6 form-inline">
            {!! Form::model($correction, ['route' => ['corrections.uploadcorrection', $enpost->id]]) !!}
                <div class="form-inline">
                    {!! Form::label('crtext', '添削') !!}
                    {!! Form::textarea('crtext', old('crtext')) !!}
                </div>

                <div class="form-inline mt-3">
                    {!! Form::label('comment', 'コメント') !!}
                    {!! Form::textarea('comment', old('comment')) !!}
                </div>

                {!! Form::submit('投稿する', ['class' => 'btn btn-primary btn-block mt-4 mb-4']) !!}
            {!! Form::close() !!}
            <a class="btn btn-danger btn-block" href="#">キャンセル</a>
        </div>
    @endif
@endsection