<x-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Admin Courses Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Total Courses -->
                <div class="p-4 bg-blue-200 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Total Courses</h3>
                    <p class="text-xl text-gray-800">{{ $totalCourses }}</p>
                </div>
                
                <!-- Total Enrolled Students -->
                <div class="p-4 bg-green-200 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Total Enrolled Students</h3>
                    <p class="text-xl text-gray-800">{{ $totalStudents }}</p>
                </div>

                <!-- Total Teachers -->
                <div class="p-4 bg-yellow-200 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Total Teachers</h3>
                    <p class="text-xl text-gray-800">{{ $totalTeachers }}</p>
                </div>

                <!-- Courses Without Enrollment -->
                <div class="p-4 bg-red-200 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Courses Without Enrollment</h3>
                    <ul class="list-disc list-inside pl-5 text-gray-700">
                        @forelse ($coursesWithoutEnrollment as $course)
                            <li>{{ $course->name }}</li>
                        @empty
                            <li class="text-gray-500">All courses have enrollment.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        
        @foreach ($courses as $course)
        <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-6">
            <button class="accordion-button flex items-center justify-between w-full p-6 bg-gray-200 text-gray-700 font-bold focus:outline-none">
                <span>{{ $course->name }}</span>
                <i class="fas fa-chevron-down accordion-icon text-gray-600"></i>
            </button>
            <div class="accordion-panel hidden overflow-hidden transition-all duration-500 max-h-0">
                <div class="p-6 border-t border-gray-300">
                    <div>
                        <h4 class="font-semibold text-gray-600 mb-2">Teachers:</h4>
                        <ul class="list-disc list-inside pl-5 text-gray-700">
                            @forelse ($course->teachers as $teacher)
                                <li class="text-gray-800">{{ $teacher->first_name }} {{ $teacher->last_name }}</li>
                            @empty
                                <li class="text-gray-500 italic">No teachers assigned yet.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="mt-4">
                        <h4 class="font-semibold text-gray-600">
                            Students Enrolled: <span class="text-gray-800 font-bold">{{ $course->students->count() }}</span>
                        </h4>
                        <ul class="list-disc list-inside pl-5 text-gray-700">
                            @forelse ($course->students as $student)
                                <li class="text-gray-800">{{ $student->first_name }} {{ $student->last_name }}</li>
                            @empty
                                <li class="text-gray-500 italic">No students enrolled yet.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    </div>

    <script>
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', () => {
                const panel = button.nextElementSibling;
                const icon = button.querySelector('.accordion-icon');
    
                if (!panel.classList.contains('hidden')) {
                    panel.style.maxHeight = null;
                    setTimeout(() => panel.classList.toggle('hidden'), 500); // Close smoothly
                } else {
                    panel.classList.toggle('hidden');
                    panel.style.maxHeight = panel.scrollHeight + 'px'; // Open smoothly
                }
                icon.classList.toggle('rotate-180');
            });
        });
    </script>
    
</x-layout>
