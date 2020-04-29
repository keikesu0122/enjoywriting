<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Enjoywriting</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/commons_buttons.css')}}">
        <link rel="stylesheet" href="{{asset('css/commons_correctionsindex.css')}}">
        <link rel="stylesheet" href="{{asset('css/commons_enpostsdetails.css')}}">
        <link rel="stylesheet" href="{{asset('css/commons_enpostsindex.css')}}">
        <link rel="stylesheet" href="{{asset('css/commons_navbar.css')}}">
        <link rel="stylesheet" href="{{asset('css/corrections_correct.css')}}">
        <link rel="stylesheet" href="{{asset('css/enposts_create.css')}}">
        <link rel="stylesheet" href="{{asset('css/enposts_edit.css')}}">
        <link rel="stylesheet" href="{{asset('css/enposts_show.css')}}">
        <link rel="stylesheet" href="{{asset('css/layouts_app.css')}}">
        <link rel="stylesheet" href="{{asset('css/users_card.css')}}">
        <link rel="stylesheet" href="{{asset('css/users_navtabs.css')}}">
    </head>

    <body>
　　　　
        @include('commons.navbar')
        
        <div class="container">
            @include('commons.error_messages')
            @include('commons.flash_messages')
            @yield('content')
        </div>
        
        <a href="#" class="return_top"><i class="fas fa-arrow-up"></i></a>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{ asset('/js/vue.js') }}"></script>
        <script src="{{ asset('/js/jquery.js') }}"></script>
    </body>
</html>