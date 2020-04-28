@extends('layouts.app')

@section('content')
    <div class="row">
        @if(Auth::check())
            <div class="col-sm-8 enposts-create-container">
               {!! Form::open(['route' => ['enposts.update', $enpost->id], 'files'=>true, 'method'=>'put', 'class'=>'enposts-create-form']) !!}
                    {{csrf_field()}}
                    <div class="enposts-create-title">
                        {!! Form::label('title', 'タイトル', ['class' => 'enposts-create-title-label']) !!}
                        {!! Form::text('title', old('title', $enpost->title), ['class' => 'enposts-create-title-text', 'placeholder'=>'必須：タイトルを英語で入力して下さい。']) !!}
                    </div>
    
                    <div class="enposts-create-entext">
                        {!! Form::label('entext', '英文', ['class' => 'enposts-create-entext-label']) !!}
                        {!! Form::textarea('entext', old('entext', $enpost->entext), ['class' => 'enposts-create-entext-text', 'placeholder'=>'必須：本文を英語で入力して下さい。']) !!}
                    </div>
    
                    <div class="enposts-create-jptext">
                        {!! Form::label('jptext', '和文', ['class' => 'enposts-create-jptext-label']) !!}
                        {!! Form::textarea('jptext', old('jptext', $enpost->jptext), ['class' => 'enposts-create-jptext-text', 'placeholder'=>'任意：本文の和訳を入力して下さい。']) !!}
                    </div>
    
                    <div class="enposts-edit-postimg">
                        {!! Form::label('postimg', '画像', ['class' => 'enposts-edit-postimg-label']) !!}
                        {!! Form::file('postimg', ['class' => 'enposts-edit-postimg-file']) !!}
                    　　<img class="enposts-edit-postimg-currentimg img-fluid" src="{{\Storage::disk('s3')->url('post_images/'.$enpost->postimg)}}" width="200" height="auto" alt="">
                    </div>
    
                    <div id="enposts-create-tag">
                        <div class="enposts-create-tag-form">
                            {!! Form::label('tag', 'タグ', ['class' => 'enposts-create-tag-label'])  !!}
                            <div @mouseover="mouseover" @mouseleave="mouseleave">
                                {!! Form::text('tag',old('tag',$oldtag), ['class' => 'enposts-create-tag-text', 'placeholder'=>'任意：タグを入力して下さい。']) !!}
                            </div>
                        </div>
                        <div class="enposts-create-tag-note" v-show="isMouseOn">複数のタグを入力する場合には各タグをカンマで区切ってください。</div>
                    </div>
                    
                    {!! Form::submit('投稿する', ['class' => 'enposts-create-button']) !!}
                {!! Form::close() !!}
            </div>
        @endif
    </div>
@endsection