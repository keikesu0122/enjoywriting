@extends('layouts.app')

@section('content')
    @include('commons.enpostsdetails', ['enpost'=>$enpost, 'tags'=>$tags, 'likes'=>$likes])
    <div class="enposts-show-buttons">
           @include('commons.buttons',['enpost'=>$enpost]) 
    </div>
    @if($bestcorrection!=null)
         <div class="enposts-show-corrections">
            <div class="enposts-show-corrections-header">
                <h4>{{$bestcorrection->user->name}}さんの添削</h4>
                <h4 class="bestcorrection">ベスト添削です!!</h4>
             </div>
        </div>
        <div class="enposts-show-corrections-content">
            <div class="enposts-show-corrections-crtext">
                <h5 class="text-muted">英文</h5>
                <di class="enposts-show-corrections-crtext-text">{{$bestcorrection->crtext}}</di>
            </div>
            <div class="enposts-show-corrections-comment">
                <h5 class="text-muted">コメント</h5>
                <div class="enposts-show-corrections-comment-text">{{$bestcorrection->comment}}</div>
            </div>
        </div>
    @endif
    @foreach ($corrections as $correction)
        @if($correction->bcflag==false)
            <div class="enposts-show-corrections">
                <div class="enposts-show-corrections-header">
                    <h4>{{$correction->user->name}}さんの添削</h4>
                    @if(Auth::user()->id==$enpost->user_id && $enpost->status==0)
                        {!! Form::open(['route' => ['corrections.bestcorrection', $correction->id], 'class'=>'enposts-show-corrections-button', 'method'=>'put']) !!}
                            {!! Form::submit('ベスト添削', ['class' => "btn btn-warning"]) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
                <div class="enposts-show-corrections-content">
                    <div class="enposts-show-corrections-crtext">
                        <h5 class="text-muted">英文</h5>
                        <di class="enposts-show-corrections-crtext-text">{{$correction->crtext}}</di>
                    </div>
                    <div class="enposts-show-corrections-comment">
                        <h5 class="text-muted">コメント</h5>
                        <div class="enposts-show-corrections-comment-text">{{$correction->comment}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(\Auth::user()->id==$correction->user_id)
                    <div class="form-inline mb-1 col-sm-4">
                        @if($enpost->status==0)
                            {!! link_to_route('corrections.correct', '編集', ['id'=>$enpost->id], ['class' => 'btn btn-primary mr-2']) !!}
                        @endif
                        <button class="btn btn-danger commons-buttons-modal-open">削除</button>
                        <div class="commons-buttons-modal">
                            <div class="modal-content">
                                <p>本当に削除しますか？</p>
                                <ul>
                                    <li>
                                       {!! Form::open(['route' => ['corrections.destroy', $correction->id], 'method' => 'delete']) !!}
                                          {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                                       {!! Form::close() !!}
                                    </li>
                                    <li>
                                        <button class="btn btn-default modal-return">戻る</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    @endforeach
@endsection