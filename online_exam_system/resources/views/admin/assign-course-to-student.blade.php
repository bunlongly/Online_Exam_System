<x-layout>
    <div class="max-w-lg mx-auto mt-10 shadow-lg p-6 rounded-lg bg-white">
        <h1 class="text-3xl mb-6 text-center font-semibold text-gray-800">Assign Courses to Students</h1>
        <form action="{{ route('admin.store-assign-course-to-student') }}" method="POST">
            @csrf

            <!-- Student Selection with Search -->
            <div class="mb-6">
                <label for="student_search" class="block mb-2 text-sm font-medium text-gray-700">Search Students</label>
                <input type="text" id="student_search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2" placeholder="Search students..." onkeyup="filterStudents()">
                
                <div id="student_list" class="max-h-60 overflow-y-auto">
                    @foreach ($students as $student)
                        <div class="flex items-center mb-2">
                            <input type="radio" id="student_{{ $student->id }}" name="student_id" value="{{ $student->id }}" class="mr-2">
                            <label for="student_{{ $student->id }}">
                                {{ $student->first_name }} {{ $student->last_name }} ({{ $student->email }} - ID: {{ $student->unique_id }})
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Course Selection with Search -->
            <div class="mb-6">
                <label for="course_search" class="block mb-2 text-sm font-medium text-gray-700">Search Courses</label>
                <input type="text" id="course_search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2" placeholder="Search courses..." onkeyup="filterCourses()">
                
                <div id="course_list" class="max-h-60 overflow-y-auto">
                    @foreach ($courses as $course)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="course_{{ $course->id }}" name="course_ids[]" value="{{ $course->id }}" class="mr-2">
                            <label for="course_{{ $course->id }}">{{ $course->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center mt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Assign Courses</button>
            </div>
        </form>
    </div>
</x-layout>

<script>
function filterStudents() {
    let input = document.getElementById('student_search');
    let filter = input.value.toUpperCase();
    let studentList = document.getElementById('student_list');
    let students = studentList.getElementsByTagName('div');
    
    for (let i = 0; i < students.length; i++) {
        let label = students[i].getElementsByTagName('label')[0];
        if (label.textContent.toUpperCase().indexOf(filter) > -1) {
            students[i].style.display = "";
        } else {
            students[i].style.display = "none";
        }
    }
}

function filterCourses() {
    let input = document.getElementById('course_search');
        let filter = input.value.toUpperCase();
        let courseList = document.getElementById('course_list');
        let courses = courseList.getElementsByTagName('div');
        
        for (let i = 0; i < courses.length; i++) {
            let label = courses[i].getElementsByTagName('label')[0];
            if (label.textContent.toUpperCase().indexOf(filter) > -1) {
                courses[i].style.display = "";
            } else {
                courses[i].style.display = "none";
            }
        }
    
}
</script>
