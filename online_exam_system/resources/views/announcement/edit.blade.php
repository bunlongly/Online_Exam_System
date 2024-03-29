<x-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-6">Edit Announcement</h1>

        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="my-5">
                <a href="{{ url()->previous() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
                </div>

                
            {{-- Title Field --}}
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" value="{{ $announcement->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            {{-- Message Field --}}
            <div class="mb-4">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message:</label>
                <textarea name="message" id="message" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>{{ $announcement->message }}</textarea>
            </div>

            {{-- Course Select Field --}}
            <div class="mb-4">
                <label for="course_id" class="block text-gray-700 text-sm font-bold mb-2">Select Course (optional):</label>
                <select name="course_id" id="course_id" data-initial="{{ $announcement->course_id }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Select a Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" @if($course->id == $announcement->course_id) selected @endif>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Student Select Field --}}
            <div class="mb-4">
                <label for="student_id" class="block text-gray-700 text-sm font-bold mb-2">Select Student (optional):</label>
                <select name="student_id" id="student_id" data-initial="{{ $announcement->student_id }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Select a Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" @if($student->id == $announcement->student_id) selected @endif>{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Announcement
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseSelect = document.getElementById('course_id');
            const studentSelect = document.getElementById('student_id');
            
            // Initial check in case one of them is pre-selected
            handleDropdownChange();
    
            courseSelect.addEventListener('change', handleDropdownChange);
            studentSelect.addEventListener('change', handleDropdownChange);
    
            function handleDropdownChange() {
                if (courseSelect.value !== '') {
                    studentSelect.disabled = true;
                    if (!studentSelect.hasAttribute('data-initial')) {
                        studentSelect.value = '';
                    }
                } else {
                    studentSelect.disabled = false;
                }
    
                if (studentSelect.value !== '') {
                    courseSelect.disabled = true;
                    if (!courseSelect.hasAttribute('data-initial')) {
                        courseSelect.value = '';
                    }
                } else {
                    courseSelect.disabled = false;
                }
            }
        });
    </script>
    
</x-layout>
