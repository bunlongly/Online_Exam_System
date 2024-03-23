<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Login
        </h2>
        <p class="mb-4">Log into your account</p>
    </header>

    <form method="POST" action="/users/authenticate">
        @csrf
        <div class="form-control w-full">
            <input type="email" name="email" id="email" required value="{{ old('email') }}">
            <label for="email">Email</label>
            @error('email')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-control w-full">
            <input type="password" name="password" id="password" required value="{{ old('password') }}">
            <label for="password">Password</label>
            @error('password')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="mb-6">
            <button
                type="submit"
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
            >
                Sign In
            </button>
        </div>
        
    </form>


    </x-card>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const labels = document.querySelectorAll('.form-control label');
            labels.forEach(label => {
                label.innerHTML = label.innerText
                    .split('')
                    .map((letter, idx) => `<span style="transition-delay:${idx * 50}ms">${letter}</span>`)
                    .join('');
            });
        });
        </script>
</x-layout>

