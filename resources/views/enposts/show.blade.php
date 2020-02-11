@extends('layouts.app')

@section('content')
    @include('commons.enpostsdetails', ['enpost'=>$enpost, 'tags'=>$tags])
    <div class="row mt-4">
        <div class="col-sm-3 mb-5">
           @include('commons.buttons',['enpost'=>$enpost]) 
        </div>
    </div>
    @if($bestcorrection!=null)
        <div class="row mb-3 mt-3">
            <div class="col-sm-3">
                <h4>{{$bestcorrection->user->name}}さんの添削</h4>
            </div>
             <div class="col-sm-3">
                <h4>ベスト添削です!!</h4>
             </div>
        </div>
        <div class="row">
             <div class="col-sm-5">
                <h5 class="mb-2 text-muted">英文</h5>
                {{$bestcorrection->crtext}}
            </div>
            <div class="col-sm-5">
                <h5 class="mb-2 text-muted">コメント</h5>
                {{$bestcorrection->comment}}
            </div>
        </div>
    @endif
    @foreach ($corrections as $correction)
        @if($correction->bcflag==false)
            <div class="row mb-3 mt-3">
                <div class="col-sm-3">
                    <h4>{{$correction->user->name}}さんの添削</h4>
                </div>
                 <div class="col-sm-3">
                    @if(Auth::user()->id==$enpost->user_id && $enpost->status==0)
                        {!! Form::open(['route' => ['corrections.bestcorrection', $correction->id], 'method'=>'put']) !!}
                            {!! Form::submit('ベスト添削', ['class' => "btn btn-warning btn-block"]) !!}
                        {!! Form::close() !!}
                    @endif
                 </div>
            </div>
            <div class="row">
                 <div class="col-sm-4">
                    <h5 class="mb-2 text-muted">英文</h5>
                    {{$correction->crtext}}
                </div>
                <div class="col-sm-4">
                    <h5 class="mb-2 text-muted">コメント</h5>
                    {{$correction->comment}}
                </div>
                @if(\Auth::user()->id==$correction->user_id)
                    <div class="form-inline col-sm-4">
                        @if($enpost->status==0)
                            {!! link_to_route('corrections.correct', '編集', ['id'=>$enpost->id], ['class' => 'btn btn-primary mr-2']) !!}
                        @endif
                        {!! Form::open(['route' => ['corrections.destroy', $correction->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        @endif
    @endforeach
@endsection