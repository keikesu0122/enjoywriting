<header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark"> 
        <a class="navbar-brand" href="/">Enjoywriting</a>
         
    　  @if(Auth::check())
            {!! link_to_route('enposts.create', '投稿する', [], ['class' => 'btn btn-primary ml-3']) !!}
        @endif
         
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item mr-3">{!! link_to_route('users.ranking', 'ランキング', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item mr-3">{!! link_to_route('users.show', 'マイページ', ['id'=>\Auth::user()->id], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                @else
                    <li class="nav-item mr-3">{!! link_to_route('signup.get', '会員登録') !!}</li>
                    <li class="nav-item">{!! link_to_route('login', 'ログイン') !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>