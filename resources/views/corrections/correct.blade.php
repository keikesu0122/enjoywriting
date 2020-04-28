@extends('layouts.app')

@section('content')
    @include('commons.enpostsdetails', ['enpost'=>$enpost, 'tags'=>$tags])
    @if(Auth::check())
        <div>
            @if($enpost->is_correctedby())
                {!! Form::model($correction, ['route' => ['corrections.updatecorrection', $enpost->id], 'method'=>'put', 'class'=>'corrections-correct-form']) !!}
                    <div class="corrections-correct-input">
                        <div class="corrections-correct-crtext">
                            {!! Form::label('crtext', '添削', ['class' => 'corrections-correct-crtext-label']) !!}
                            {!! Form::textarea('crtext', $correction->crtext, ['class' => 'corrections-correct-crtext-text']) !!}
                        </div>
        
                        <div class="corrections-correct-comment">
                            {!! Form::label('comment', 'コメント',  ['class' => 'corrections-correct-comment-label']) !!}
                            {!! Form::textarea('comment', $correction->comment, ['class' => 'corrections-correct-comment-text']) !!}
                        </div>
                    </div>
                    {!! Form::submit('投稿する', ['class' => 'corrections-correct-button btn btn-primary']) !!}
                {!! Form::close() !!}
            @else
                {!! Form::model($correction, ['route' => ['corrections.uploadcorrection', $enpost->id], 'class'=>'corrections-correct-form']) !!}
                    <div class="corrections-correct-input">
                        <div class="corrections-correct-crtext">
                            {!! Form::label('crtext', '添削', ['class' => 'corrections-correct-crtext-label']) !!}
                            {!! Form::textarea('crtext', old('crtext'), ['class' => 'corrections-correct-crtext-text']) !!}
                        </div>
        
                        <div class="corrections-correct-comment">
                            {!! Form::label('comment', 'コメント', ['class' => 'corrections-correct-comment-label']) !!}
                            {!! Form::textarea('comment', old('comment'), ['class' => 'corrections-correct-comment-text']) !!}
                        </div>
                    </div>
                    {!! Form::submit('投稿する', ['class' => 'corrections-correct-button btn btn-primary']) !!}
                {!! Form::close() !!}
            @endif
        </div>
    @endif
@endsection