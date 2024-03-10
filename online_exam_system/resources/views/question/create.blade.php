<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Create a Question</h2>
            <p class="mb-4">Enter question details below</p>
        </header>
        
        <form method="POST" action="/question" enctype="multipart/form-data">
            @csrf
            
            <!-- Course Selection -->
            <div class="mb-6">
                <label for="course" class="inline-block text-lg mb-2">Course</label>
                <select id="course" name="course" class="border border-gray-200 rounded p-2 w-full">
                    <option selected disabled>Choose a course</option>
                    <option value="Software requirement" {{ old('course') == 'Software requirement' ? 'selected' : '' }}>Software requirement</option>
                    <option value="Database System" {{ old('course') == 'Database System' ? 'selected' : '' }}>Database System</option>
                    <option value="Mathematic" {{ old('course') == 'Mathematic' ? 'selected' : '' }}>Mathematic</option>
                    <option value="Web development" {{ old('course') == 'Web development' ? 'selected' : '' }}>Web development</option>
                    <option value="Mobile development" {{ old('course') == 'Mobile development' ? 'selected' : '' }}>Mobile development</option>
                </select>
                @error('course')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <!-- Select Question Type -->
            <div class="mb-6">
                <label for="type" class="inline-block text-lg mb-2">Question Type</label>
                <select id="type" name="type" class="border border-gray-200 rounded p-2 w-full"  value="{{old('type')}}">
                    <option value="True Or False">True Or False</option>
                    <option value="Multiple Choice">Multiple Choice</option>
                    <option value="Enter the Answer">Enter the Answer</option>
                </select>
            </div>

            <!-- Select Difficulty -->
            <div class="mb-6">
                <label for="difficulty" class="inline-block text-lg mb-2">Question Difficulty</label>
                <select id="difficulty" name="difficulty" class="border border-gray-200 rounded p-2 w-full"  value="{{old('difficulty')}}">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                </select>
            </div>

            <!-- Question Text -->
            <div class="mb-6">
                <label for="question" class="inline-block text-lg mb-2">Question</label>
                <input id="question" type="text" name="question" class="border border-gray-200 rounded p-2 w-full" placeholder="Enter question..."  value="{{old('question')}}"/>
                @error('question')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

             <!-- Multiple Choice Options -->
             <div id="multipleChoiceOptions" style="display: none;">
                <div>
                    <label for="optionA">Option A</label>
                    <input type="text" id="optionA" name="options[A]" class="block w-full text-gray-700 bg-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

                </div>
                <div>
                    <label for="optionB">Option B</label>
                    <input type="text" id="optionB" name="options[B]"class="block w-full text-gray-700 bg-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                <div>
                    <label for="optionC">Option C</label>
                    <input type="text" id="optionC" name="options[C]"class="block w-full text-gray-700 bg-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                <div>
                    <label for="optionD">Option D</label>
                    <input type="text" id="optionD" name="options[D]"class="block w-full text-gray-700 bg-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </div>
                <div>
                    <label>Correct Answer:</label>
                    <select name="correct_answer">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>

            <!-- True/False Options -->
            <div id="trueFalseOptions" style="display: none;">
                <label>Correct Answer:</label>
                <select name="correct_answer">
                    <option value="True">True</option>
                    <option value="False">False</option>
                </select>
            </div>

            <!-- Enter the Answer Option -->
            <div id="enterAnswerOptions" style="display: none;">
                <label for="correctAnswer" class="inline-block text-lg mb-2 font-medium text-gray-700">Correct Answer</label>
                <input placeholder="Enter the Keyword" type="text" id="correctAnswer" name="correct_answer" 
                    class="border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base rounded-lg block w-full p-2.5"  value="{{old('correct_answer')}}">
            </div>

            <div class="flex justify-between items-center mt-6">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-110">
                    Create Question
                </button>
            
                <a href="/question" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-110">
                    Back
                </a>
            </div>
        </form>
    </x-card>

    <script>
         function showHideOptions() {
            var type = document.getElementById('type').value;
            document.getElementById('multipleChoiceOptions').style.display = (type == 'Multiple Choice') ? 'block' : 'none';
            document.getElementById('trueFalseOptions').style.display = (type == 'True Or False') ? 'block' : 'none';
            document.getElementById('enterAnswerOptions').style.display = (type == 'Enter the Answer') ? 'block' : 'none';
        }

        document.getElementById('type').addEventListener('change', showHideOptions);
        showHideOptions(); // Call on page load
    </script>
</x-layout>
