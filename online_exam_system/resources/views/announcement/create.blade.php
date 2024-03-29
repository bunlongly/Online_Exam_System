<x-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-6">Create Announcement</h1>

        <form action="{{ route('announcements.store') }}" method="POST">
            @csrf


            <div class="my-5">
            <a href="{{ url()->previous() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back
            </a>
            </div>

            {{-- Title Field --}}
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            {{-- Message Field --}}
            <div class="mb-4">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message:</label>
                <textarea name="message" id="message" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>

            {{-- Course Select Field --}}
            <div class="mb-4">
                <label for="course_id" class="block text-gray-700 text-sm font-bold mb-2">Select Course (for course-wide announcement):</label>
                <select name="course_id" id="course_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Select a Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Hidden fields for Course ID and Student ID -->
            <input type="hidden" name="selected_course_id" id="selected_course_id">
            <input type="hidden" name="selected_student_id" id="selected_student_id">

            {{-- Student Select Field (for specific student messaging) --}}
            <div class="mb-4">
                <label for="student_id" class="block text-gray-700 text-sm font-bold mb-2">Select Student (for individual messaging):</label>
                <select name="student_id" id="student_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">-- Select a Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
            </div>


          

            {{-- Submit Button --}}
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Announcement
                </button>
            </div>
        </form>
    </div> 

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseSelect = document.getElementById('course_id');
            const studentSelect = document.getElementById('student_id');
            
            courseSelect.addEventListener('change', handleDropdownChange);
            studentSelect.addEventListener('change', handleDropdownChange);

            function handleDropdownChange() {
            const selectedCourseIdField = document.getElementById('selected_course_id');
            const selectedStudentIdField = document.getElementById('selected_student_id');

            if (courseSelect.value !== '') {
                studentSelect.disabled = true;
                studentSelect.value = '';
                selectedCourseIdField.value = courseSelect.value;
                selectedStudentIdField.value = '';
            } else {
                studentSelect.disabled = false;
                selectedCourseIdField.value = '';
            }

            if (studentSelect.value !== '') {
                courseSelect.disabled = true;
                courseSelect.value = '';
                selectedStudentIdField.value = studentSelect.value;
                selectedCourseIdField.value = '';
            } else {
                courseSelect.disabled = false;
                selectedStudentIdField.value = '';
            }
}

        });
    </script>
</x-layout>
