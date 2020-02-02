@extends('layouts.app')

@section('content')
    @include('commons.enpostsdetails', ['enpost'=>$enpost, 'tags'=>$tags])
    <div class="row mt-4">
        <div class="col-sm-3 mb-5">
            <div class="form-inline">
                @if(Auth::user()->id==$enpost->user->id)
                    {!! link_to_route('enposts.edit', '編集', ['id'=>$enpost->id], ['style' => 'display:inline', 'class' => 'btn btn-primary mr-2']) !!}
                    {!! Form::open(['route' => ['enposts.destroy', $enpost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['style' => 'display:inline','class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                @else
                    {!! link_to_route('corrections.correct', '添削', ['user_id'=>$enpost->user_id, 'enpost_id'=>$enpost->id], ['class' => 'btn btn-secondary mr-2']) !!}
                @endif
            </div>
        </div>
    </div>
    @foreach ($corrections as $correction)
        <div class="row mb-3 mt-3">
             <h4>{{$correction->user->name}}さんの添削</h4>
        </div>
        <div class="row">
             <div class="col-sm-6">
                <h5 class="mb-2 text-muted">英文</h5>
                {{$correction->crtext}}
            </div>
            <div class="col-sm-6">
                <h5 class="mb-2 text-muted">コメント</h5>
                {{$correction->comment}}
            </div>
        </div>
    @endforeach
@endsection