{{-- resources/views/question/edit.blade.php --}}

<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Edit a Question</h2>
            <p class="mb-4">Update question details below</p>
        </header>
      
        <form method="POST" action="{{ route('question.update', $question->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Course Selection -->
            <div class="mb-6">
                <label for="course" class="inline-block text-lg mb-2">Course</label>
                <select id="course" name="course" class="border border-gray-200 rounded p-2 w-full">
                    <!-- Options -->
                    <option value="Software requirement" {{ $question->course == 'Software requirement' ? 'selected' : '' }}>Software requirement</option>
                    <option value="Database System" {{ $question->course == 'Database System' ? 'selected' : '' }}>Database System</option>
                    <option value="Mathematic" {{ $question->course == 'Mathematic' ? 'selected' : '' }}>Mathematic</option>
                    <option value="Web development" {{ $question->course == 'Web development' ? 'selected' : '' }}>Web development</option>
                    <option value="Mobile development" {{ $question->course == 'Mobile development' ? 'selected' : '' }}>Mobile development</option>
                </select>
                @error('course')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>



            {{-- Question Type --}}
            <div class="mb-6">
                <label for="type" class="inline-block text-lg mb-2">Question Type</label>
                <input id="type" type="text" class="border border-gray-200 rounded p-2 w-full" value="{{ $question->type }}" disabled>
                <input type="hidden" name="type" value="{{ $question->type }}"> <!-- Hidden field to submit the data -->
            </div>


            <!-- Select Difficulty -->
            <div class="mb-6">
                <label for="difficulty" class="inline-block text-lg mb-2">Question Difficulty</label>
                <select id="difficulty" name="difficulty" class="border border-gray-200 rounded p-2 w-full">
                    <option value="Easy" {{ $question->difficulty == 'Easy' ? 'selected' : '' }}>Easy</option>
                    <option value="Medium" {{ $question->difficulty == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Hard" {{ $question->difficulty == 'Hard' ? 'selected' : '' }}>Hard</option>
                </select>
            </div>

            <!-- Question Text -->
            <div class="mb-6">
                <label for="question" class="inline-block text-lg mb-2">Question</label>
                <input id="question" type="text" name="question" class="border border-gray-200 rounded p-2 w-full" placeholder="Enter question..." value="{{ $question->question }}"/>
                @error('question')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Points -->
            <div class="mb-6">
                <label for="score" class="inline-block text-lg mb-2">Points</label>
                <input type="number" id="score" name="score" class="border border-gray-200 rounded p-2 w-full" placeholder="1.00" value="{{ $question->score }}"/>
                @error('score')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Multiple Choice Options -->
            <div id="multipleChoiceOptions" style="{{ $question->type == 'Multiple Choice' ? '' : 'display: none;' }}">
                @php $options = json_decode($question->options, true); @endphp
                <div id="multipleChoiceOptions" style="{{ $question->type == 'Multiple Choice' ? '' : 'display: none;' }}">
                    @php
                        $options = json_decode($question->options, true);
                    @endphp
                
                    <div>
                        <label for="optionA">Option A</label>
                        <input type="text" id="optionA" name="options[A]" class="block w-full text-gray-700 bg-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ $options['A'] ?? '' }}">
                    </div>
                
                    <div>
                        <label for="optionB">Option B</label>
                        <input type="text" id="optionB" name="options[B]" class="block w-full text-gray-700 bg-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ $options['B'] ?? '' }}">
                    </div>
                
                    <div>
                        <label for="optionC">Option C</label>
                        <input type="text" id="optionC" name="options[C]" class="block w-full text-gray-700 bg-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ $options['C'] ?? '' }}">
                    </div>
                
                    <div>
                        <label for="optionD">Option D</label>
                        <input type="text" id="optionD" name="options[D]" class="block w-full text-gray-700 bg-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" value="{{ $options['D'] ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- True/False Options -->
            <div id="trueFalseOptions" style="{{ $question->type == 'True Or False' ? '' : 'display: none;' }}">
                <label>Correct Answer:</label>
                <select name="correct_answer" class="border border-gray-200 rounded p-2 w-full">
                    <option value="True" {{ $question->correct_answer == 'True' ? 'selected' : '' }}>True</option>
                    <option value="False" {{ $question->correct_answer == 'False' ? 'selected' : '' }}>False</option>
                </select>
            </div>


        <!-- Multiple Choice Correct Answer -->
        @if($question->type == 'Multiple Choice')
        @php $options = json_decode($question->options, true); @endphp
        <div id="correctAnswerMultipleChoice" class="mb-6">
            <label>Correct Answer:</label>
            <select name="correct_answer" class="border border-gray-200 rounded p-2 w-full">
                <option value="A" {{ $question->correct_answer == 'A' ? 'selected' : '' }}>A: {{ $options['A'] ?? '' }}</option>
                <option value="B" {{ $question->correct_answer == 'B' ? 'selected' : '' }}>B: {{ $options['B'] ?? '' }}</option>
                <option value="C" {{ $question->correct_answer == 'C' ? 'selected' : '' }}>C: {{ $options['C'] ?? '' }}</option>
                <option value="D" {{ $question->correct_answer == 'D' ? 'selected' : '' }}>D: {{ $options['D'] ?? '' }}</option>
            </select>
        </div>
        <!-- True/False Correct Answer -->
        @elseif($question->type == 'True Or False')
        <div id="correctAnswerTrueFalse" class="mb-6">
            <label>Correct Answer:</label>
            <select name="correct_answer" class="border border-gray-200 rounded p-2 w-full">
                <option value="True" {{ $question->correct_answer == 'True' ? 'selected' : '' }}>True</option>
                <option value="False" {{ $question->correct_answer == 'False' ? 'selected' : '' }}>False</option>
            </select>
        </div>
        <!-- Enter the Answer Correct Answer -->
        @elseif($question->type == 'Enter the Answer')
        <div id="correctAnswerEnterAnswer" class="mb-6">
            <label for="correctAnswer" class="inline-block text-lg mb-2 font-medium text-gray-700">Correct Answer</label>
            <input type="text" id="correctAnswer" name="correct_answer" class="border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base rounded-lg block w-full p-2.5" value="{{ $question->correct_answer }}">
        </div>
        @endif

            <div class="flex justify-between items-center mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-110">
                    Update Question
                </button>

                <a href="/question" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-110">
                    Back
                </a>
            </div>

        </form>
    </x-card>
</x-layout>
