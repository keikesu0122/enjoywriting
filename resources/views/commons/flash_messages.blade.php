@if (session('flash_message'))
    <div class="flash-messages">
        <div>{{ session('flash_message') }}</div>
    </div>
@endif