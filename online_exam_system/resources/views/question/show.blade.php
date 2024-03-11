{{-- resources/views/question/show.blade.php --}}

<x-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden max-w-xl mx-auto">
            <div class="bg-gradient-to-br from-indigo-600 to-blue-400 p-4 sm:p-5 lg:p-6 text-white">
                <h1 class="text-3xl font-bold mb-2">Course: {{ $question->course }}</h1>
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

                <div class="bg-green-100 p-3 rounded-lg shadow mb-6">
                    <label class="text-green-700 font-semibold">Correct Answer</label>
                    <p class="text-green-600 mt-1">{{ $question->correct_answer }}</p>
                </div>

                <div class="bg-gray-100 p-3 rounded-lg shadow mb-6">
                    <label class="text-gray-700 font-semibold">Created By</label>
                    <p class="text-gray-600 mt-1">{{ $question->user->name }}</p>
                </div>

                <div class="flex justify-center">
                    <a href="{{ route('question.index') }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                        Back to Question Bank
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
