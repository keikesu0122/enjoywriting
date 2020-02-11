@extends('layouts.app')

@section('content')
    @include('commons.enpostsdetails', ['enpost'=>$enpost, 'tags'=>$tags])
    @if(Auth::check())
        <div class="row mt-5">
            @if($enpost->is_correctedby())
                <div class="col-sm-6 form-inline">
                    {!! Form::model($correction, ['route' => ['corrections.updatecorrection', $enpost->id], 'method'=>'put']) !!}
                        <div class="form-inline">
                            {!! Form::label('crtext', '添削') !!}
                            {!! Form::textarea('crtext', $correction->crtext) !!}
                        </div>
        
                        <div class="form-inline mt-3">
                            {!! Form::label('comment', 'コメント') !!}
                            {!! Form::textarea('comment', $correction->comment) !!}
                        </div>
        
                        {!! Form::submit('投稿する', ['class' => 'btn btn-primary btn-block mt-4 mb-4']) !!}
                    {!! Form::close() !!}
                </div>
            @else
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
                </div>
            @endif
        </div>
    @endif
@endsection