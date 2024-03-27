<x-layout>
    <h1 class="text-3xl font-semibold leading-tight text-teal mb-6 mt-4 text-center">Dashboard</h1>
    
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-10 text-center">Enrolled Courses</h2>
        <div class="flex flex-wrap justify-center gap-8">
            @foreach($enrolledCourses as $course)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out w-64">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-inteal mb-3 truncate">{{ $course->name }}</h3>
                        <div>
                            @if($course->teachers->isNotEmpty())
                                <h4 class="text-grey-900 font-semibold mb-2">Teachers:</h4>
                                <ul class="space-y-1">
                                    @foreach($course->teachers as $teacher)
                                        <li class="text-gray-700 text-sm font-medium">{{ $teacher->first_name }} {{ $teacher->last_name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-600 italic text-sm">No teachers assigned yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
        
        <div class="container mx-auto px-4 sm:px-8 max-w-4xl mb-8">
        <h1 class="text-3xl font-semibold leading-tight text-teal mb-6 mt-4 text-center">Available Exams</h1>
        <div class="my-2">
            @forelse($exams as $exam)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-700">{{ $exam->title }}</h2>
                        <p class="text-gray-600">Course: <span class="font-semibold">{{ $exam->course->name }}</span></p>
                        <p class="text-gray-600">Duration: <span class="font-semibold">{{ $exam->duration }} minutes</span></p>
                        <p class="text-gray-600">Number of Questions: <span class="font-semibold">{{ $exam->questions->count() }}</span></p>
                        <p class="text-gray-600">Start Time: <span class="font-semibold">{{ $exam->start_time->format('d/m/Y H:i') }}</span></p>
                        <a href="{{ route('student.exam.show', $exam) }}" class="mt-4 inline-block bg-teal text-white font-semibold px-4 py-2 rounded hover:bg-teal transition duration-300 ease-in-out">Take Exam</a>
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
