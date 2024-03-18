<x-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800">Exam Details: {{ $exam->title }}</h1>
            <a href="{{ route('exam.index') }}" class="text-blue-500 hover:text-blue-700 font-bold">Back to Exam Dashboard</a>
        </div>

        
        <!-- Exam Information -->
        <div class="bg-white rounded-xl shadow-xl p-6 mt-4">
            <div class="grid grid-cols-2 gap-4">
                <div><p class="text-lg"><strong>Title:</strong> {{ $exam->title }}</p></div>
                <div><p class="text-lg"><strong>Course:</strong> {{ $exam->course }}</p></div>
                <div><p class="text-lg"><strong>Duration:</strong> {{ $exam->duration }} minutes</p></div>
                <div><p class="text-lg"><strong>Total Questions:</strong> {{ $exam->questions->count() }}</p></div>
                <div><p class="text-lg"><strong>Total Score:</strong> {{ $totalScore }}</p></div>
                <div><p class="text-lg"><strong>Created By: </strong>   {{ $exam->user->name ?? 'Unknown' }}</p></div>
                
            </div>
        </div>

      <!-- Publication Status and Exam Times -->
      <div class="flex justify-between items-center mt-3">
        <p class="text-lg font-bold">Status: 
            <span class="{{ $exam->published ? 'text-green-600' : 'text-red-600' }} font-semibold">
                <i class="{{ $exam->published ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                {{ $exam->published ? 'Published' : 'Unpublished' }}
            </span>
        </p>
        <div class="flex">
            <p class="text-lg"><strong>Start Time:</strong> {{ $exam->start_time->format('d/m/Y H:i') }}</p>
            <p>------</p>
            <p class="text-lg"><strong>End Time:</strong> {{ $exam->end_time->format('d/m/Y H:i') }}</p>
        </div>
    </div>


        <!-- Questions List -->
        <div class="bg-white rounded-xl shadow-xl p-6 mt-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Questions:</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Question</th>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Difficulty</th>
                            <th class="px-4 py-2">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question) {{-- Use $questions here --}}
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 font-semibold">{{ $question->id }}</td>
                                <td class="px-4 py-2">{{ $question->question }}</td>
                                <td class="px-4 py-2">{{ $question->type }}</td>
                                <td class="px-4 py-2">{{ $question->difficulty }}</td>
                                <td class="px-4 py-2">{{ $question->score }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $questions->links() }}
            </div>
        </div>


        <!-- Action Buttons -->
        <div class="mt-4 space-x-4">
            <a href="{{ route('exam.edit', $exam)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">Edit Exam</a>
            <form action="{{route('exam.destroy', $exam)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this exam?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">Delete Exam</button>
            </form>
            <form action="{{ route('exam.toggle-publish', $exam)}}" method="POST" class="inline">
                @csrf
                @method('PATCH') 
                <button type="submit" onclick="return confirm('Are you sure you want to {{ $exam->published ? 'unpublish' : 'publish' }} this exam?');" class="bg-{{ $exam->published ? 'red' : 'green' }}-500 hover:bg-{{ $exam->published ? 'red' : 'green' }}-700 text-white font-bold py-2 px-4 rounded">
                    {{ $exam->published ? 'Unpublish' : 'Publish' }}
                </button>
            </form>
            
        </div>

    </div>
</x-layout>