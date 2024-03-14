<x-layout>
  
        <div class="container mx-auto p-6">
            <div class="mb-4">
                <h1 class="text-3xl font-bold text-gray-700">Create New Exam</h1>
            </div>
    
            <form method="POST" action="/path-to-your-submit-handler" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
    
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
    
                <div class="mb-6">
                    <label for="type" class="inline-block text-lg mb-2">Question Type</label>
                    <select id="type" name="type" class="border border-gray-200 rounded p-2 w-full">
                        <option selected disabled>Choose a type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mb-6">
                    <label for="difficulty" class="inline-block text-lg mb-2">Difficulty</label>
                    <select id="difficulty" name="difficulty" class="border border-gray-200 rounded p-2 w-full">
                        <option selected disabled>Choose a difficulty</option>
                        @foreach ($difficulties as $difficulty)
                            <option value="{{ $difficulty }}">{{ $difficulty }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mb-4">
                    <label for="questions" class="block text-gray-700 text-sm font-bold mb-2">Select Questions</label>
                    <select multiple class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="questions" name="questions[]">
                        @foreach($questions as $question)
                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @endforeach
                    </select>
    
                    <small class="text-gray-600">Use Ctrl+Click to select multiple questions</small>
                </div>
    

            <!-- Exam Duration -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">Duration (minutes)</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="duration" name="duration" type="number" placeholder="Enter duration in minutes">
                <!-- Handle errors -->
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
       document.getElementById('course').addEventListener('change', updateQuestions);
    document.getElementById('type').addEventListener('change', updateQuestions);
    document.getElementById('difficulty').addEventListener('change', updateQuestions);

    function updateQuestions() {
        const course = document.getElementById('course').value;
        const type = document.getElementById('type').value;
        const difficulty = document.getElementById('difficulty').value;
        const questionsSelect = document.getElementById('questions');

        // Ensure all fields have valid selections
        if (course && type && difficulty) {
            fetch(`/fetch-questions?course=${course}&type=${type}&difficulty=${difficulty}`)
                .then(response => response.json())
                .then(data => {
                    questionsSelect.innerHTML = ''; // Clear existing options
                    data.forEach(question => {
                        questionsSelect.innerHTML += `<option value="${question.id}">${question.question}</option>`;
                    });
                })
                .catch(error => console.error('Error:', error));
        } else {
            questionsSelect.innerHTML = '<option value="">Please select course, type, and difficulty first</option>';
        }
    }

        </script>   
</x-layout>
