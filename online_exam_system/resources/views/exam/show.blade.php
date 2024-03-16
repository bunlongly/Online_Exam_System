<x-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800">Exam Details: {{ $exam->title }}</h1>
            <a href="{{ route('exam.index') }}" class="text-blue-500 hover:text-blue-700 font-bold">Back to Dashboard</a>
        </div>

        <!-- Exam Information -->
        <div class="bg-white rounded-xl shadow-xl p-6 mt-4">
            <p class="text-lg"><strong>Title:</strong> {{ $exam->title }}</p>
            <p class="text-lg"><strong>Course:</strong> {{ $exam->course }}</p>
            <p class="text-lg"><strong>Duration:</strong> {{ $exam->duration }} minutes</p>
            <p class="text-lg"><strong>Total Questions:</strong> {{ $exam->questions->count() }}</p>
            <p class="text-lg"><strong>Total Score :</strong> {{ $totalScore }}</p>
        </div>

        <!-- Questions List -->
        <div class="bg-white rounded-xl shadow-xl p-6 mt-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Questions:</h2>
            <ul class="list-disc list-inside">
                @foreach($exam->questions as $question)
                    <li class="text-lg">{{ $question->question }}<span class="ml-3"> ( {{ $question->type }} ) </span> <span class="ml-3">( {{ $question->difficulty }} ) </span> <span class="ml-3"> ( score :{{$question->score}} )</span> </li>
                @endforeach
            </ul>
        </div>

        <!-- Action Buttons -->
        <div class="mt-4 space-x-4">
            <a href="" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                Edit Exam
            </a>
            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this exam?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                    Delete Exam
                </button>
            </form>
            <form action="" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                    {{ $exam->published ? 'Unpublish Exam' : 'Publish Exam' }}
                </button>
            </form>
        </div>
    
        <!-- Publication Status -->
        <div class="mt-4">
            <p class="text-lg"><strong>Status:</strong> {{ $exam->published ? 'Published' : 'Unpublished' }}</p>
        </div>
    </div>
</x-layout>
