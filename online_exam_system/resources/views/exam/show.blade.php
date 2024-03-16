<x-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-gray-800">Exam Details: {{ $exam->title }}</h1>

        <!-- Exam Information -->
        <div class="bg-white rounded-xl shadow-xl p-6 mt-4">
            <p><strong>Title:</strong> {{ $exam->title }}</p>
            <p><strong>Course:</strong> {{ $exam->course }}</p>
            <p><strong>Duration:</strong> {{ $exam->duration }} minutes</p>
            <p><strong>Total Questions:</strong> {{ $exam->questions->count() }}</p>
        </div>

        <!-- Questions List -->
        <div class="bg-white rounded-xl shadow-xl p-6 mt-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Questions:</h2>
            <ul>
                @foreach($exam->questions as $question)
                    <li>{{ $question->question }} ({{ $question->type }})</li>
                @endforeach
            </ul>
        </div>

        <!-- Back Button -->
        <a href="{{ route('exam.index') }}" class="text-blue-500 hover:text-blue-700 mt-4">Back to Dashboard</a>
    </div>
</x-layout>
