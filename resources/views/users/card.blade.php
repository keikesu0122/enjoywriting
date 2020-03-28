<div class="card" style="padding:0px 0px 0px 0px;">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body" style="margin: 0 auto;">
        <img class="rounded img-fluid" src="{{\Storage::disk('s3')->url('self_images/'.$user->selfimg)}}" width="200" height="auto" alt="">
    </div>
    <div class="card-body">
        {{$user->introtext}}
    </div>
    @if(Auth::user()->id==$user->id)
        <div class="form-inline mt-2 mb-2" style="justify-content: space-around;">
            {!! link_to_route('users.edit', '登録情報編集', ['id'=>$user->id], ['class' => 'btn btn-primary']) !!}
            {!! link_to_route('users.passwordedit', 'パスワード変更', ['id'=>$user->id], ['class' => 'btn btn-success']) !!}
        </div>
        <div id="users-card-modal">
            <button class="btn btn-danger ml-2 mb-3" v-on:click="openModal">退会</button>
             <div id="users-card-overlay" v-show="showContent" v-on:click="closeModal">
                <div id="users-card-overlaycontent"  v-on:click.stop="stopEvent">
                    <p>本当に退会しますか？</p>
                    <ul id="users-card-ul-unregister">
                        <li>
                            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    　　        {!! Form::submit('退会', ['class' => 'btn btn-danger ml-2']) !!}
                　　          {!! Form::close() !!}
                        </li>
                        <li>
                            <button class="btn btn-default" v-on:click="closeModal" id="users-card-return">戻る</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>