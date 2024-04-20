<x-layout>
    <div class="max-w-7xl mx-auto mt-12 px-4 sm:px-6 lg:px-8">
      <div class="bg-white shadow-lg rounded-lg p-10 flex flex-col md:flex-row gap-10 items-center">
        <!-- Image Container -->
        <div class="md:flex-1">
          <img src="{{ asset('images/online-exam-banner.png') }}" alt="Login Image" class="rounded-lg shadow-lg" />
        </div>
  
        <!-- Form Container -->
        <div class="md:flex-1">
            <div class="text-center mb-10">
              <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Login</h2>
              <p class="text-gray-600 text-lg">Log into your account</p>
            </div>
          
            <form method="POST" action="/users/authenticate" autocomplete="off" class="space-y-6">
              @csrf
              <div class="form-control w-full">
                <input type="email" name="email" id="email" required
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-laravel focus:outline-none transition duration-200 ease-in-out"
                       placeholder="Email address">
                @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
              </div>
          
              <div class="form-control w-full">
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-laravel focus:outline-none transition duration-200 ease-in-out"
                       placeholder="Password">
                @error('password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
              </div>
          
      
          
              <button type="submit"
                      class="w-full inline-flex items-center justify-center bg-laravel text-white rounded-lg py-3 px-6 text-lg font-semibold hover:bg-black transition-colors duration-200 ease-in-out shadow-md hover:shadow-lg">
                Sign In
              </button>
            </form>
          </div>
          
      </div>
    </div>
  </x-layout>
  