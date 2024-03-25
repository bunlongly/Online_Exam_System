<x-layout>
    <div class="max-w-lg mx-auto mt-10 shadow-lg p-6 rounded-lg bg-white">
        <h1 class="text-3xl mb-6 text-center font-semibold text-gray-800">Assign Courses to Teacher</h1>
        <form action="{{ route('admin.storeAssignCourse') }}" method="POST">

            @csrf
            <!-- Teacher Selection -->
            <div class="mb-6">
                <label for="teacher_search" class="block mb-2 text-sm font-medium text-gray-700">Search Teachers</label>
                <input type="text" id="teacher_search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2" placeholder="Search teachers..." onkeyup="filterTeachers()">
                
                <div id="teacher_list" class="max-h-60 overflow-y-auto">
                    @foreach ($teachers as $teacher)
                        <div class="flex items-center mb-2">
                            <input type="radio" id="teacher_{{ $teacher->id }}" name="teacher_id" value="{{ $teacher->id }}" class="mr-2">
                            <label for="teacher_{{ $teacher->id }}">
                                {{ $teacher->first_name }} {{ $teacher->last_name }} ({{ $teacher->email }} - ID: {{ $teacher->unique_id }})
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
                            <input type="checkbox" id="course_{{ $course->id }}" name="courses[]" value="{{ $course->id }}" class="mr-2">
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

function filterTeachers() {
        let input = document.getElementById('teacher_search');
        let filter = input.value.toUpperCase();
        let teacherList = document.getElementById('teacher_list');
        let teachers = teacherList.getElementsByTagName('div');
        
        for (let i = 0; i < teachers.length; i++) {
            let label = teachers[i].getElementsByTagName('label')[0];
            if (label.textContent.toUpperCase().indexOf(filter) > -1) {
                teachers[i].style.display = "";
            } else {
                teachers[i].style.display = "none";
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
