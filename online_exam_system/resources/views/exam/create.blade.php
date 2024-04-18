<x-layout>
  
    <div class="container mx-auto p-6 bg-white shadow-md rounded">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Create New Exam</h1>
        <div class="flex justify-between mb-4">
            <button id="resetButton" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Reset Filters
            </button>
            <div class="flex items-center">
                <label for="numQuestions" class="text-gray-700 text-sm font-bold mr-2">Number of Questions to Shuffle</label>
                <input type="number" id="numQuestions" name="numQuestions" min="1" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter number">
                <button id="shuffleButton" class="ml-2 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Shuffle</button>
            </div>
        </div>
    
        <form method="POST" action="{{ route('exam.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">TItle Exam</label>
                <textarea style=" resize:none; " id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="2" placeholder="Enter a title of the exam..."></textarea>
            </div>
            <div>
                <label for="course" class="block text-lg text-gray-700">Course</label>
                <select id="course" name="course_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option selected disabled value="">Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
                @error('course')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
    
            <div class="flex space-x-4 mt-5">
                <div class="w-1/2">
                    <label for="type" class="block text-lg text-gray-700">Question Type</label>
                    <select id="type" name="type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected disabled value="">Select Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/2">
                    <label for="difficulty" class="block text-lg text-gray-700">Difficulty</label>
                    <select id="difficulty" name="difficulty" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected disabled value="">Select Difficulty</option>
                        @foreach ($difficulties as $difficulty)
                            <option value="{{ $difficulty }}">{{ $difficulty }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    
         
           

            <div class="mb-4 mt-6 questions-container">
                <div class="flex items-center mb-2">
                    <label for="questions" class="text-gray-700 text-sm font-bold">Select Questions</label>
                    
                </div>
                
                <div class="max-h-60 overflow-y-auto border border-gray-300 rounded-md">
                    @foreach($questions as $question)
                        <div class="flex items-center justify-between p-2 hover:bg-gray-100 question-item">
                            <div class="flex items-center">
                                <input type="checkbox" id="question_{{ $question->id }}" name="questions[]" value="{{ $question->id }}" class="rounded text-indigo-600 focus:ring-indigo-500">
                                <label for="question_{{ $question->id }}" class="ml-2 text-sm text-gray-700">{{ $question->question }} (Course: {{ $question->course->name }}, Type: {{ $question->type }}, Difficulty: {{ $question->difficulty }})</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="flex justify-between">
                <div id="selectedCount" class="mt-2 text-sm text-gray-600"></div>
                <button id="selectAllButton" type="button" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1 px-3 text-sm rounded shadow border border-blue-300">
                    Select All Questions
                </button>
            </div>
            
    
            <div class="mb-4 flex items-center mt-5">
                <label class="inline-block text-lg mr-2" for="duration">Duration (minutes)</label>
                <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="duration" name="duration" type="number" placeholder="Enter duration in minutes">
                @error('duration')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="flex space-x-4 mt-5">
                <div class="w-1/2">
                    <label for="start_time" class="block text-lg text-gray-700">Start Time</label>
                    <input type="datetime-local" id="start_time" name="start_time" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Select start time">
                </div>
                <div class="w-1/2">
                    <label for="end_time" class="block text-lg text-gray-700">End Time</label>
                    <input type="datetime-local" id="end_time" name="end_time" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Select end time">
                </div>
            </div>
    
    
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Exam</button>
                <a href="/exam" class="text-blue-500 hover:text-blue-700">Back to All Exams</a>
            </div>
        </form>
    </div>

<script>

function updateQuestions() {
    const courseSelect = document.getElementById('course');
    const typeSelect = document.getElementById('type');
    const difficultySelect = document.getElementById('difficulty');
    const questionsContainer = document.querySelector('.questions-container');

    let queryParams = new URLSearchParams();
    if (courseSelect.value) queryParams.set('course_id', courseSelect.value);
    if (typeSelect.value) queryParams.set('type', typeSelect.value);
    if (difficultySelect.value) queryParams.set('difficulty', difficultySelect.value);

    
    fetch(`/fetch-questions?${queryParams.toString()}`)
        .then(response => response.json())
        .then(data => {
            questionsContainer.innerHTML = '';
            if (data.length) {
                data.forEach(question => {
                    const questionHtml = `
                        <div class="flex items-center justify-between p-2 hover:bg-gray-100 question-item">
                            <div class="flex items-center">
                                <input type="checkbox" id="question_${question.id}" name="questions[]" value="${question.id}" class="rounded text-indigo-600 focus:ring-indigo-500">
                                <label for="question_${question.id}" class="ml-2 text-sm text-gray-700">${question.question} (Course: ${question.course.name}, Type: ${question.type}, Difficulty: ${question.difficulty})</label>
                            </div>
                        </div>
                    `;
                    questionsContainer.innerHTML += questionHtml;
                });
            } else {
                questionsContainer.innerHTML = '<div class="p-2 text-gray-700">No questions found for selected filters</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            questionsContainer.innerHTML = '<div class="p-2 text-red-500">Error loading questions</div>';
        });
}

    //Reset all filter
    function resetFilters() {
        const courseSelect = document.getElementById('course');
        const typeSelect = document.getElementById('type');
        const difficultySelect = document.getElementById('difficulty');

        if (courseSelect) courseSelect.selectedIndex = 0;
        if (typeSelect) typeSelect.selectedIndex = 0;
        if (difficultySelect) difficultySelect.selectedIndex = 0;

        updateQuestions();
        updateSelectedCount();
    }



    //Shuffle the Questions
    function shuffleQuestions() {
    const courseSelect = document.getElementById('course');
    const numQuestionsInput = document.getElementById('numQuestions');
    const questionsContainer = document.querySelector('.questions-container');
    const course = courseSelect.value;
    const numQuestions = parseInt(numQuestionsInput.value);

    if (!course) {
        alert("Please select a course first.");
        return;
    }

    if (!numQuestions || numQuestions <= 0) {
        alert("Please enter a valid number of questions to shuffle.");
        return;
    }

    let queryParams = new URLSearchParams();
    queryParams.set('course', course);

    fetch(`/fetch-questions?${queryParams.toString()}`)
        .then(response => response.json())
        .then(data => {
            if (data.length) {
                let shuffledQuestions = shuffleArray(data).slice(0, numQuestions);
                questionsContainer.innerHTML = '';
                shuffledQuestions.forEach(question => {
                    const questionHtml = `
                        <div class="flex items-center justify-between p-2 hover:bg-gray-100 question-item">
                            <div class="flex items-center">
                                <input type="checkbox" id="question_${question.id}" name="questions[]" value="${question.id}" class="rounded text-indigo-600 focus:ring-indigo-500">
                                <label for="question_${question.id}" class="ml-2 text-sm text-gray-700">${question.question} (Course: ${question.course}, Type: ${question.type}, Difficulty: ${question.difficulty})</label>
                            </div>
                        </div>
                    `;
                    questionsContainer.innerHTML += questionHtml;
                });
                setupQuestionSelection(); // Re-bind the event listeners
            } else {
                questionsContainer.innerHTML = '<div class="p-2 text-gray-700">No questions found for this course</option>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            questionsContainer.innerHTML = '<div class="p-2 text-red-500">Error loading questions</div>';
        });
}


    //Shuffle All the Question
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function updateSelectedCount() {
        const selectedQuestions = document.querySelectorAll('input[name="questions[]"]:checked');
        const countDisplay = document.getElementById('selectedCount');
        countDisplay.textContent = `Selected Questions: ${selectedQuestions.length}`;
    }

    
    // Function to handle question selection
    function setupQuestionSelection() {
        const questionsContainer = document.querySelector('.questions-container');
        questionsContainer.addEventListener('change', (event) => {
            if (event.target.matches('input[name="questions[]"]')) {
                updateSelectedCount();
                // Toggle the visual indicator for selected questions
                event.target.closest('.question-item').classList.toggle('bg-gray-200', event.target.checked);
            }
        });
    }


    
    //Select all the question 
    function selectAllQuestions() {
    const questions = document.querySelectorAll('.questions-container input[type="checkbox"]');
    questions.forEach(question => {
        if (!question.closest('.hidden')) {
            question.checked = true;
            question.closest('.question-item').classList.add('bg-gray-200');
        }
    });
    updateSelectedCount();
}


            document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('course')?.addEventListener('change', updateQuestions);
    document.getElementById('type')?.addEventListener('change', updateQuestions);
    document.getElementById('difficulty')?.addEventListener('change', updateQuestions);
    document.getElementById('resetButton')?.addEventListener('click', resetFilters);
    document.getElementById('shuffleButton')?.addEventListener('click', shuffleQuestions);
    document.getElementById('selectAllButton').addEventListener('click', selectAllQuestions);
    setupQuestionSelection();
    updateSelectedCount(); 
});
</script>  

</x-layout>