<x-layout>
    <div class="container mx-auto mt-10 px-4">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-4xl font-semibold text-gray-800 mb-6">Create New Course</h1>
            <form action="{{route('courses.store')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Course Name:</label>
                    <input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">Create Course</button>
            </form>
        </div>
    </div>
</x-layout>
