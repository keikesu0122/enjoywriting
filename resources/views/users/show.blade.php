@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card',['user'=>$user])
        </aside>
        <div class="col-sm-8" id="user-tab">
            @include('users.navtabs',['user'=>$user])
            <section v-show="activeTab==='enposts-tab'">
              @include('commons.enpostsindex',['enposts'=>$enposts])
            </section>
            <section v-show="activeTab==='corrections-tab'">
              @include('commons.correctionsindex',['enposts'=>$corrections])
            </section>
        </div>
    </div>
@endsection