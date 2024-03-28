@if(session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="flex inline-flex fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif

@if(session('success'))
    <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 4000)" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-sm px-48 py-3 rounded">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 4000)" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-red-500 text-white text-sm px-56 py-3 rounded text-center">
        <p>{{ session('error') }}</p>
    </div>

    
@endif