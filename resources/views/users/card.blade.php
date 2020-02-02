<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        <img class="rounded img-fluid" src="{{ asset('/storage/self_images/'.$user->selfimg) }}" alt="">
        {{$user->introtext}}
    </div>
</div>