<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        <img class="rounded img-fluid" src="{{\Storage::disk('s3')->url('self_images/'.$user->selfimg)}}" alt="">
        <div class="card-body-text">{{$user->introtext}}</div>
    </div>
    @if(Auth::user()->id==$user->id)
        <div class="users-card-information">
            {!! link_to_route('users.edit', '登録情報編集', ['id'=>$user->id], ['class' => 'btn btn-primary users-card-edit']) !!}
            {!! link_to_route('users.passwordedit', 'パスワード変更', ['id'=>$user->id], ['class' => 'btn btn-success users-card-password']) !!}
        </div>
        <div class="users-card-modal">
            <button class="btn btn-danger" v-on:click="openModal">退会</button>
             <div class="overlay" v-show="showContent" v-on:click="closeModal">
                <div class="overlay-content"  v-on:click.stop="stopEvent">
                    <p>本当に退会しますか？</p>
                    <ul>
                        <li>
                            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    　　        {!! Form::submit('退会', ['class' => 'btn btn-danger ml-2']) !!}
                　　          {!! Form::close() !!}
                        </li>
                        <li>
                            <button class="btn btn-default" v-on:click="closeModal" class="overlay-return">戻る</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>