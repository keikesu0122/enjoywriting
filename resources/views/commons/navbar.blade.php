<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark"> 
        <a class="navbar-brand" href="/">Enjoywriting</a>
         
         @if(Auth::check())
            <a class="btn btn-primary ml-3" href="#">投稿する</a>
        @endif
         
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item"><a href="#" class="nav-link">マイページ</a></li>
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                @else
                    <li class="nav-item mr-3">{!! link_to_route('signup.get', '会員登録') !!}</li>
                    <li class="nav-item"></li>{!! link_to_route('login', 'ログイン') !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>