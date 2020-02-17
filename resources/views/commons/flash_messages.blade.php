@if (session('flash_message'))
    <div style="color: #00ff7f; font-weight: bolder;">
        {{ session('flash_message') }}
    </div>
@endif