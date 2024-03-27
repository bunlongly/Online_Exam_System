<x-layout>
    <div class="container mx-auto px-4 sm:px-8 max-w-4xl">
        <h1 class="text-3xl font-semibold leading-tight text-gray-800 mb-6 mt-4 text-center">Available Exams</h1>

      <!-- Display Enrolled Courses and Instructors -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Enrolled Courses</h2>
            @forelse($enrolledCourses as $course)
                <div class="bg-white shadow rounded-lg p-4 mb-4">
                    <p class="text-lg text-gray-700">Course: {{ $course->name }}</p>
                    <p class="text-gray-600">Teacher: {{ optional($course->teacher)->first_name ?? 'Not Assigned' }}</p>
                </div>
            @empty
                <p class="text-gray-700">You are not enrolled in any courses.</p>
            @endforelse
        </div>

        <div class="my-2">
            @forelse($exams as $exam)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-700">{{ $exam->title }}</h2>
                        <p class="text-gray-600">Course: <span class="font-semibold">{{ $exam->course->name }}</span></p>
                        <p class="text-gray-600">Duration: <span class="font-semibold">{{ $exam->duration }} minutes</span></p>
                        <p class="text-gray-600">Number of Questions: <span class="font-semibold">{{ $exam->questions->count() }}</span></p>
                        <p class="text-gray-600">Start Time: <span class="font-semibold">{{ $exam->start_time->format('d/m/Y H:i') }}</span></p>
                        <a href="{{ route('student.exam.show', $exam) }}" class="mt-4 inline-block bg-indigo-500 text-white font-semibold px-4 py-2 rounded hover:bg-indigo-600 transition duration-300 ease-in-out">Take Exam</a>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-xl text-gray-700">No exams available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
