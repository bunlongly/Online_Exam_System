<x-layout>
  
        <div class="container mx-auto p-6">
            <div class="mb-4">
                <h1 class="text-3xl font-bold text-gray-700">Create New Exam</h1>
            </div>
    
            <button type="button" id="resetButton" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Reset Filters
            </button>
            <form method="POST" action="/path-to-your-submit-handler" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
    
                <div class="mb-6">
                    <label for="course" class="inline-block text-lg mb-2">Course</label>
                    <select id="course" name="course" class="border border-gray-200 rounded p-2 w-full">
                        <option  selected disabled value="">Select Course</option>
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
    
                <div class="mb-6">
                    <label for="type" class="inline-block text-lg mb-2">Question Type</label>
                    <select id="type" name="type" class="border border-gray-200 rounded p-2 w-full">
                        <option  selected disabled value="">Select Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mb-6">
                    <label for="difficulty" class="inline-block text-lg mb-2">Difficulty</label>
                    <select id="difficulty" name="difficulty" class="border border-gray-200 rounded p-2 w-full">
                        <option  selected disabled value="">Select Difficulty</option>
                        @foreach ($difficulties as $difficulty)
                            <option value="{{ $difficulty }}">{{ $difficulty }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mb-4">
                    <label for="questions" class="block text-gray-700 text-sm font-bold mb-2">Select Questions</label>
                    <select multiple id="questions" name="questions[]" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach($questions as $question)
                            <option value="{{ $question->id }}">
                                {{ $question->question }} (Course: {{ $question->course }}, Type: {{ $question->type }}, Difficulty: {{ $question->difficulty }})
                            </option>
                        @endforeach
                    </select>
                    <small class="text-gray-600">Use Ctrl+Click to select multiple questions</small>
                </div>
                
    

            <!-- Exam Duration -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">Duration (minutes)</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="duration" name="duration" type="number" placeholder="Enter duration in minutes">
                @error('duration')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            

            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="examDescription">
                    Exam Description
                </label>
                <textarea id="examDescription" name="examDescription" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4" placeholder="Enter a brief description of the exam..."></textarea>
            </div>


            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Exam
                </button>
                <a href="/exam" class="text-blue-500 hover:text-blue-700">
                    Back to All Exams
                </a>
            </div>

            </form>
        </div>
    
    <script>
 function updateQuestions() {
            const courseSelect = document.getElementById('course');
            const typeSelect = document.getElementById('type');
            const difficultySelect = document.getElementById('difficulty');
            const questionsSelect = document.getElementById('questions');

            let queryParams = new URLSearchParams();

            if (courseSelect.value) queryParams.set('course', courseSelect.value);
            if (typeSelect.value) queryParams.set('type', typeSelect.value);
            if (difficultySelect.value) queryParams.set('difficulty', difficultySelect.value);

            if (queryParams.toString()) {
                fetch(`/fetch-questions?${queryParams.toString()}`)
                    .then(response => response.json())
                    .then(data => {
                        questionsSelect.innerHTML = '';
                        if (data.length) {
                            data.forEach(question => {
                                questionsSelect.innerHTML += `<option value="${question.id}">${question.question} - ${question.course}/${question.type}/${question.difficulty}</option>`;
                            });
                        } else {
                            questionsSelect.innerHTML = '<option>No questions found for selected filters</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        questionsSelect.innerHTML = '<option>Error loading questions</option>';
                    });
            } else {
                questionsSelect.innerHTML = '<option>Select at least one filter to see questions</option>';
            }
        }


    // Reset Filters Button Functionality
    document.getElementById('resetButton').addEventListener('click', () => {
        document.getElementById('course').selectedIndex = 0;
        document.getElementById('type').selectedIndex = 0;
        document.getElementById('difficulty').selectedIndex = 0;
        updateQuestions(); // To refresh the questions list based on the reset filters
    });

        // Attach event listeners
        document.getElementById('course').addEventListener('change', updateQuestions);
        document.getElementById('type').addEventListener('change', updateQuestions);
        document.getElementById('difficulty').addEventListener('change', updateQuestions);
        </script>   
</x-layout>
