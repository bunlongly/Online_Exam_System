<x-layout>
    <div class="container mx-auto px-4 sm:px-8 py-12">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold text-center mb-6">Exam Results</h1>

            <div class="bg-white shadow rounded-lg p-6">
                <p class="text-xl mb-4"><strong>Total Score:</strong> {{ $totalScore }}</p>
                <p class="text-xl mb-4">You answered <strong>{{ $correctAnswersCount }}</strong> questions correctly.</p>
                <p class="text-xl {{ $passed ? 'text-green-600' : 'text-red-600' }}">{{ $passed ? 'Congratulations, you passed!' : 'Sorry, you did not pass.' }}</p>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('student.dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">Back to Dashboard</a>

        </div>
    </div>
</x-layout>
