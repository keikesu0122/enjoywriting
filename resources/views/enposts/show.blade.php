@extends('layouts.app')

@section('content')
    <h3>{{$enpost->title}}</h3>
    <div class="row">
         <div class="col-sm-6">
            <h4 class="mb-2 text-muted">英文</h4>
            {{$enpost->entext}}
        </div>
        <div class="col-sm-6">
            <h4 class="mb-2 text-muted">和文</h4>
            {{$enpost->jptext}}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-6">
            <h4 class="mb-2 text-muted">画像</h4>
            <img class="mr-2 rounded" src="{{ asset('/storage/post_images/'.$enpost->postimg) }}" alt="">
        </div>
        <div class="col-sm-6">
            <h4 class="mb-2 text-muted">タグ</h4>
            <ul>
            @foreach ($tags as $tag)
                <li style="display:inline" class="mr-2">{{$tag->tag}}</li>
            @endforeach
            </ul>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-3">
            <div class="form-inline">
                @if(Auth::user()->id==$enpost->user->id)
                    {!! link_to_route('enposts.edit', '編集', ['id'=>$enpost->id], ['style' => 'display:inline', 'class' => 'btn btn-primary mr-2']) !!}
                    {!! Form::open(['route' => ['enposts.destroy', $enpost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['style' => 'display:inline','class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                @else
                    <a class="btn btn-secondary" href="#">添削</a>
                @endif
            </div>
        </div>
    </div>     
@endsection