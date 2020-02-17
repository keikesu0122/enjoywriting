@if (session('flash_message'))
    <div class="rounded" style="background-color: #99FFFF; width: 250px; height: 40px; padding-left:10px; padding-top:10px;">
        {{ session('flash_message') }}
    </div>
@endif