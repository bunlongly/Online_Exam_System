<x-layout>
    <div class="container mx-auto p-6">
        <!-- Profile Header -->
        <div class="flex items-center space-x-4 p-6 mb-8 bg-white rounded-xl shadow-xl">
            <div class="flex-shrink-0 relative">
                <img class="h-24 w-24 rounded-full border-4 border-blue-600 transition duration-300 hover:border-blue-700" src="{{ asset('images/user.png') }}" alt="Profile photo">
                <label for="file-upload" class="cursor-pointer absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 shadow-lg hover:bg-blue-700 transition duration-300">
                    <i class="fas fa-camera"></i>
                </label>
                <input id="file-upload" type="file" class="hidden" onchange="previewImage(event)"/>
            </div>
            <div>
                <h4 class="text-3xl font-semibold text-blue-800">John Doe</h4>
                <span class="text-sm text-gray-600">Joined January 2021</span>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="bg-white p-8 rounded-xl shadow-xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                <!-- User Info -->
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="text-lg font-semibold text-blue-700">johndoe@example.com</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Username</p>
                    <p class="text-lg font-semibold text-blue-700">bunlong</p>
                </div>
            </div>

                       <!-- Courses & Stats -->
                       <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-10">
                        <!-- Courses -->
                        <div class="lg:col-span-2 bg-blue-50 p-6 rounded-lg shadow-sm">
                            <h5 class="text-2xl font-bold text-blue-800 mb-4">Courses</h5>
                            @if($user->courses->isNotEmpty())
                                <ul class="list-disc list-inside pl-5 text-lg text-blue-700">
                                    @foreach($user->courses as $course)
                                        <li>{{ $course->name }}</li> <!-- Assuming the course has a 'name' field -->
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-lg text-blue-700">No courses assigned.</p>
                            @endif
                        </div>
                        
                        <!-- Stats -->
                        <div class="lg:col-span-2 bg-gray-100 p-6 rounded-lg shadow-sm">
                            <h5 class="text-2xl font-bold text-gray-800 mb-4">Activity Stats</h5>
                            <p class="text-lg text-gray-700 mb-2">Total Questions Created: <span class="font-semibold text-blue-800">51</span></p>
                            <p class="text-lg text-gray-700 mb-2">Total Exams Created: <span class="font-semibold text-blue-800">5</span></p>
                            <p class="text-lg text-gray-700 mb-2">Total Students in Software Requirement: <span class="font-semibold text-blue-800">10</span></p>
                            <p class="text-lg text-gray-700 mb-2">Total Students in Database System: <span class="font-semibold text-blue-800">20</span></p>
                            <p class="text-lg text-gray-700 mb-2">Total Students in Mathematic: <span class="font-semibold text-blue-800">15</span></p>
                            <p class="text-lg text-gray-700">Total Students in Web Development: <span class="font-semibold text-blue-800">35</span></p>
                        </div>
                    </div>
        

            <!-- Edit Profile Section -->
            <div>
                <h5 class="text-xl font-semibold text-gray-800 mb-6">Edit Profile</h5>
                <form>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Profile Inputs -->
                        <div class="mb-6">
                            <label for="username" class="block text-lg font-medium text-gray-700">Username</label>
                            <input type="text" id="username" value="bunlong" class="mt-1 p-3 block w-full border border-blue-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                            <input type="email" id="email" value="long@gmail.com" class="mt-1 p-3 block w-full border border-blue-400 rounded-md shadow-sm focus:
                            focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block text-lg font-medium text-gray-700">New Password</label>
                            <input type="password" id="password" placeholder="Enter new password" class="mt-1 p-3 block w-full border border-blue-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>
                        <div class="mb-6">
                            <label for="confirm-password" class="block text-lg font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" id="confirm-password" placeholder="Confirm new password" class="mt-1 p-3 block w-full border border-blue-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>
                    </div>
                    <!-- Update Button -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to preview image after selection
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('img');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layout>
