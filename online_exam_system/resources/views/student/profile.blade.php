<x-layout>
    <div class="container mx-auto p-6">
        <!-- Profile Header -->
        <div class="flex items-center space-x-4 p-6 mb-8 bg-white rounded-xl shadow-xl">
            <div class="flex-shrink-0 relative">
                <img class="h-24 w-24 rounded-full border-4 border-blue-600 transition duration-300 hover:border-blue-700" src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/default-profile.png') }}" alt="{{ $user->first_name }}'s photo">
                <input id="file-upload" type="file" class="hidden"/>
            </div>
            <div>
                <h4 class="text-3xl font-semibold text-blue-800">{{ $user->first_name }} {{ $user->last_name }}</h4>
                <span class="text-sm text-gray-600">Joined {{ $user->created_at->format('F Y') }}</span>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="bg-white p-8 rounded-xl shadow-xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="text-lg font-semibold text-blue-700">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Username</p>
                    <p class="text-lg font-semibold text-blue-700">{{ $user->first_name }} {{ $user->last_name }}</p>
                </div>
            </div>

           
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-10">
                <!-- Courses Section -->
                <div class="lg:col-span-2 bg-blue-100 p-6 rounded-xl shadow-md">
                    <h5 class="text-2xl font-bold text-blue-800 mb-4">Enrolled Courses</h5>
                    @if($user->courses->isNotEmpty())
                        <ul class="list-disc list-inside pl-5 text-lg text-blue-700">
                            @foreach($user->courses as $course)
                                <li class="mb-2">{{ $course->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-lg text-blue-700">No courses assigned yet.</p>
                    @endif
                </div>
                
                <!-- Stats Section -->
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-md">
                    <h5 class="text-2xl font-semibold text-gray-800 mb-6">Performance Stats</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center space-x-4 bg-light-blue-200 p-4 rounded-lg">
                            <i class="fas fa-file-alt text-blue-600 text-3xl"></i>
                            <div>
                                <p class="text-md font-medium text-gray-800">Total Exams Attempted</p>
                                <p class="text-xl font-bold text-blue-800">{{ $totalExamAttempts }}</p>
                            </div>
                        </div>
                
                        @if($highestScoreExam)
                            <div class="flex items-center space-x-4 bg-light-green-200 p-4 rounded-lg">
                                <i class="fas fa-medal text-green-600 text-3xl"></i>
                                <div>
                                    <p class="text-md font-medium text-gray-800">Highest Score</p>
                                    <p class="text-xl font-bold text-green-800">{{ $highestScoreExam->score }} in {{ $highestScoreExam->exam->course->name }}</p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center space-x-4 bg-light-red-200 p-4 rounded-lg">
                                <i class="fas fa-times-circle text-red-600 text-3xl"></i>
                                <div>
                                    <p class="text-md font-medium text-gray-800">Status</p>
                                    <p class="text-xl font-bold text-red-800">No exams completed yet</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            

            <!-- Edit Profile Section -->
            <div>
                <h5 class="text-xl font-semibold text-gray-800 mb-6">Edit Profile</h5>
                <form action="{{ route('student.profile.update') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Profile Inputs -->
                        <div class="mb-6">
                            <label for="username" class="block text-lg font-medium text-gray-700">Username</label>
                            <input type="text" id="username" name="username" value="{{ $user->first_name }}" class="mt-1 p-3 block w-full border border-blue-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" class="mt-1 p-3 block w-full border border-blue-400 rounded-md shadow-sm focus:
                            focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        </div>                        
                        <div class="mb-6">
                            <div class="mb-6">
                                <label for="current-password" class="block text-lg font-medium text-gray-700">Current Password</label>
                                <input type="password" name="current_password" id="current-password" placeholder="Enter current password" class="mt-1 p-3 block w-full border border-blue-400 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                            </div>
                        </div>

                        <!-- Profile Image Upload -->
                        <div class="mb-6">
                            <label for="profile-image" class="block text-lg font-medium text-gray-700">Profile Image</label>
                            <input type="file" name="profile_image" id="profile-image" class="mt-1 p-3 block w-full">
                        </div>

                   
                    </div>
                    @if ($errors->has('current_password'))
                    <div class="text-red-600">{{ $errors->first('current_password') }}</div>
                    @endif
              
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
