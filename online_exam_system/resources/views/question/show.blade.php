
<x-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden max-w-xl mx-auto">
            <div class="bg-gradient-to-br from-indigo-600 to-blue-400 p-4 sm:p-5 lg:p-6 text-white">
                <h1 class="text-3xl font-bold mb-2">Course: {{ $question->course->name }}</h1>
                <h2 class="text-xl font-semibold">Question Overview</h2>
            </div>
            <div class="p-4">
                <div class="mb-6">
                    <label class="text-gray-700 font-semibold block mb-2">Question</label>
                    <div class="text-gray-600 border border-gray-200 rounded p-3 bg-gray-50">{{ $question->question }}</div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                    <div class="bg-purple-100 p-3 rounded-lg shadow">
                        <label class="text-purple-700 font-semibold">Type</label>
                        <p class="text-purple-600 mt-1">{{ $question->type }}</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-lg shadow">
                        <label class="text-yellow-700 font-semibold">Difficulty</label>
                        <p class="text-yellow-600 mt-1">{{ $question->difficulty }}</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-lg shadow">
                        <label class="text-red-700 font-semibold">Score</label>
                        <p class="text-red-600 mt-1">{{ $question->score }}</p>
                    </div>
                </div>

             
                @if($question->type == 'Multiple Choice' && $options = json_decode($question->options, true))
                    <div class="mb-6">
                        <label class="text-gray-700 font-semibold block mb-2">Options</label>
                        <ul class="list-disc list-inside pl-5 bg-gray-50 border border-gray-200 rounded p-3">
                            @foreach($options as $key => $option)
                                <li class="{{ $key === $question->correct_answer ? 'text-green-600 font-semibold' : 'text-gray-600' }}">
                                    {{ $key }}: {{ $option }}
                                    @if($key === $question->correct_answer)
                                        <span class="text-green-600 font-semibold">(Correct Answer)</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif



            <div class="bg-green-100 p-3 rounded-lg shadow mb-6">
                <label class="text-green-700 font-semibold">Correct Answer</label>
                @if($question->type == 'Multiple Choice')
                    <p class="text-green-600 mt-1 font-semibold">{{ $question->correct_answer }} - {{ $options[$question->correct_answer]['text'] ?? $options[$question->correct_answer] }}</p>
                @else
                    <p class="text-green-600 mt-1">{{ $question->correct_answer }}</p>
                @endif
            </div>

                <div class="bg-gray-100 p-3 rounded-lg shadow mb-6">
                    <label class="text-gray-700 font-semibold">Created By</label>
                    <p class="text-gray-600 mt-1">{{ $question->user->first_name }}</p>
                </div>

                <div class="flex justify-between items-center px-4 py-3 bg-gray-100 rounded-b-lg">
                    <a href="{{ route('question.edit', $question->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('question.destroy', $question->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105" onclick="return confirm('Are you sure you want to delete this question?');">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                    <a href="{{ route('question.index') }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                        Back to Question Bank
                    </a>
                </div>
            </div>
        </div>
</x-layout>
