<x-layout>
    <div class="container mx-auto p-4">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Edit Course</h1>
            <a href="{{ route('courses.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to Courses</a>
        </div>
        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Course Name:</label>
                <input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{$course->name}}">
                @error('name')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Course</button>
        </form>
    </div>
</x-layout>