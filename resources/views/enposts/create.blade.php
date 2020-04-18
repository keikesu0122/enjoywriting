@extends('layouts.app')

@section('content')
    <div class="row">
        @if(Auth::check())
            <div class="col-sm-8" id="enposts-create-container">
                {!! Form::open(['route' => 'enposts.store', 'files'=>true, 'id'=>'enposts-create-form']) !!}
                    {{csrf_field()}}
                    <div id="enposts-create-title">
                        {!! Form::label('title', 'タイトル', ['id' => 'enposts-create-title-label']) !!}
                        {!! Form::text('title', old('title'), ['id' => 'enposts-create-title-text', 'placeholder'=>'必須：タイトルを英語で入力して下さい。']) !!}
                    </div>
    
                    <div id="enposts-create-entext">
                        {!! Form::label('entext', '英文', ['id' => 'enposts-create-entext-label']) !!}
                        {!! Form::textarea('entext', old('entext'), ['id' => 'enposts-create-entext-text', 'placeholder'=>'必須：本文を英語で入力して下さい。']) !!}
                    </div>
    
                    <div id="enposts-create-jptext">
                        {!! Form::label('jptext', '和文', ['id' => 'enposts-create-jptext-label']) !!}
                        {!! Form::textarea('jptext', old('jptext'), ['id' => 'enposts-create-jptext-text', 'placeholder'=>'任意：本文の和訳を入力して下さい。']) !!}
                    </div>
    
                    <div id="enposts-create-postimg">
                        {!! Form::label('postimg', '画像', ['id' => 'enposts-create-postimg-label']) !!}
                        {!! Form::file('postimg', ['id' => 'enposts-create-postimg-file']) !!}
                    </div>
    
                    <div id="enposts-create-tag">
                        <div id="enposts-create-tag-form">
                            {!! Form::label('tag', 'タグ', ['id' => 'enposts-create-tag-label'])  !!}
                            <div @mouseover="mouseover" @mouseleave="mouseleave">
                                {!! Form::text('tag',old('tag'), ['id' => 'enposts-create-tag-text', 'placeholder'=>'任意：タグを入力して下さい。']) !!}
                            </div>
                        </div>
                        <div id="enposts-create-tag-note" v-show="isMouseOn">複数のタグを入力する場合には各タグをカンマで区切ってください。</div>
                    </div>
                    
                    {!! Form::submit('投稿する', ['id' => 'enposts-create-button']) !!}
                {!! Form::close() !!}
            </div>
        @endif
    </div>
@endsection