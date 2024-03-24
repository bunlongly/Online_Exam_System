<x-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Courses</h1>
            <a href="/courses/create" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">Add Course</a>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold">Total Courses: {{ $totalCourses }}</h2>
        </div>


   
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead>
                    <tr class="text-left font-bold">
                        <th class="px-6 pt-6 pb-4">ID</th>
                        <th class="px-6 pt-6 pb-4">Course Name</th>
                        <th class="px-6 pt-6 pb-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach($courses as $course)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $course->id }}</td>
                            <td class="px-6 py-4">{{ $course->name }}</td>
                            <td class="px-6 py-4 flex items-center space-x-3">
                                <a href="{{ route('courses.edit', $course->id) }}" class="text-yellow-500 hover:text-yellow-600">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    

        <div class="m-6">
            {{ $courses->links() }}
        </div>
    </div>



</x-layout>
