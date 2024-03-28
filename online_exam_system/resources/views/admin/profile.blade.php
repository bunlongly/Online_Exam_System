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
            <!-- Teachers Section -->
            <div class="lg:col-span-2 bg-blue-100 p-6 rounded-xl shadow-md flex items-center space-x-3">
                <i class="fas fa-chalkboard-teacher text-blue-500 text-3xl"></i>
                <div>
                    <h5 class="text-lg font-semibold text-blue-800">Total Teachers</h5>
                    <p class="text-xl font-bold">{{ $totalTeachers }}</p>
                </div>
            </div>

            <!-- Students Section -->
            <div class="lg:col-span-2 bg-green-100 p-6 rounded-xl shadow-md flex items-center space-x-3">
                <i class="fas fa-user-graduate text-green-500 text-3xl"></i>
                <div>
                    <h5 class="text-lg font-semibold text-green-800">Total Students</h5>
                    <p class="text-xl font-bold">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Courses Section -->
            <div class="bg-purple-100 p-6 rounded-xl shadow-md flex items-center space-x-3">
                <i class="fas fa-book text-purple-500 text-3xl"></i>
                <div>
                    <h5 class="text-lg font-semibold text-purple-800">Total Courses</h5>
                    <p class="text-xl font-bold">{{ $totalCourses }}</p>
                </div>
            </div>

            <!-- Total Exams Section -->
            <div class="bg-orange-100 p-6 rounded-xl shadow-md flex items-center space-x-3">
                <i class="fas fa-file-alt text-orange-500 text-3xl"></i>
                <div>
                    <h5 class="text-lg font-semibold text-orange-800">Total Exams</h5>
                    <p class="text-xl font-bold">{{ $totalExams }}</p>
                </div>
            </div>

            <!-- Total Exam Attempts Section -->
            <div class="bg-red-100 p-6 rounded-xl shadow-md flex items-center space-x-3">
                <i class="fas fa-tasks text-red-500 text-3xl"></i>
                <div>
                    <h5 class="text-lg font-semibold text-red-800">Total Exam Attempts</h5>
                    <p class="text-xl font-bold">{{ $totalExamAttempts }}</p>
                </div>
            </div>

            <!-- Total Questions Section -->
            <div class="bg-yellow-100 p-6 rounded-xl shadow-md flex items-center space-x-3">
                <i class="fas fa-question text-yellow-500 text-3xl"></i>
                <div>
                    <h5 class="text-lg font-semibold text-yellow-800">Total Questions</h5>
                    <p class="text-xl font-bold">{{ $totalQuestions }}</p>
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
