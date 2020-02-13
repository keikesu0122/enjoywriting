@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="row">
            <div class="col-sm-4">
                <h3 class="mb-5">投稿数</h3>
                <ul class="list-unstyled">
                    @foreach ($users_enpost as $user_enpost)
                        @if($user_enpost->enposts_count!=0)
                            <li class="media mb-3">
                                <img class="mr-2 rounded" src="{{\Storage::disk('s3')->url('self_images/'.$user_enpost->selfimg)}}" width="120" height="auto" alt="">
                                <div class="media-body">
                                    <div>
                                        <a href="{{ route('users.show', ['id' => $user_enpost->id]) }}">{{$user_enpost->name}}</a><br>
                                        <p>{{$user_enpost->enposts_count}}件</p>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-4">
                <h3 class="mb-5">添削数</h3>
                <ul class="list-unstyled">
                    @foreach ($users_correction as $user_correction)
                        @if($user_correction->corrections_count!=0)
                            <li class="media mb-3">
                                <img class="mr-2 rounded" src="{{\Storage::disk('s3')->url('self_images/'.$user_correction->selfimg)}}" width="120" height="auto" alt="">
                                <div class="media-body">
                                    <div>
                                        <a href="{{ route('users.show', ['id' => $user_correction->id]) }}">{{$user_correction->name}}</a><br>
                                        <p>{{$user_correction->corrections_count}}件</p>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-4">
                <h3 class="mb-5">ベスト添削数</h3>
                <ul class="list-unstyled">
                    @foreach ($users_bc as $user_bc)
                        @if($user_bc->corrections_count!=0)
                            <li class="media mb-3">
                                <img class="mr-2 rounded" src="{{\Storage::disk('s3')->url('self_images/'.$user_bc->selfimg)}}" width="120" height="auto" alt="">
                                <div class="media-body">
                                    <div>
                                        <a href="{{ route('users.show', ['id' => $user_bc->id]) }}">{{$user_bc->name}}</a><br>
                                        <p>{{$user_bc->corrections_count}}件</p>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection