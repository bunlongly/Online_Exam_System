<x-layout>
        <x-card class="container">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">Create User</h2>
                <p class="mb-4">Register a new teacher or student account</p>
            </header>
    
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" class="grid gap-6"  autocomplete="off">
                @csrf
                <!-- ID Field -->
                <!-- Display ID (non-submittable) -->
            <div class="form-control w-full">
                <label>ID: <span id="displayID">AutoGeneratedID by server</span></label>
            </div>

                <!-- First Name and Last Name -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="form-control">
                        <input type="text" name="fname" id="fname" required value="{{ old('fname') }}">
                        <label for="fname">First Name</label>
                    </div>
                    <div class="form-control">
                        <input type="text" name="lname" id="lname" required value="{{ old('lname') }}">
                        <label for="lname">Last Name</label>
                    </div>
                </div>
    
                <!-- Email Field -->
                <div class="form-control w-full">
                    <input type="email" name="email" id="email" required value="{{ old('email') }}">
                    <label for="email">Email</label>
                    @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

    
                <!-- Phone Number -->
                <div class="form-control w-full">
                    <input type="number" name="phone" id="phone" required value="{{ old('phone') }}">
                    <label for="phone">Phone Number</label>
                    @error('phone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
    
                <!-- Password and Confirm Password -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="form-control">
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                        <label for="password_confirmation">Confirm Password</label>
                        @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                </div>
    
                <!-- Date of Birth Field -->
            <div class="form-control w-full">
                <input type="date" name="date_of_birth" id="date_of_birth" required value="{{old('date_of_birth')}}">
                @error('dob')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

              <!-- Profile Picture Upload -->
            <div class="form-control w-full mb-4">
                <input type="file" name="profile_image" id="profile_image" class="border border-gray-300 rounded p-2 w-full">
                @error('profile_image')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            
                <!-- Role Selection -->
                <div class="form-control w-full">
                    <select name="role" id="role" required>
                        <option value="">Select Role</option>
                        <option value="teacher">teacher</option>
                        <option value="student">student</option>
                    </select>
                </div>
    
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn">Create User</button>
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
