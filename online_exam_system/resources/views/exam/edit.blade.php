
    <x-layout>
        <div class="container mx-auto p-6 bg-white shadow-md rounded">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Edit Exam: {{ $exam->title }}</h1>
            <form method="POST" action="{{ route('exam.update', $exam) }}">
                @csrf
                @method('PUT')
    
                <!-- Title -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                    <textarea style="resize:none;" data-default-value="{{ $exam->title }}" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="2">{{ $exam->title }}</textarea>
                </div>
    
                    <!-- Hidden Course Input -->
                    <input type="hidden" name="course" value="{{ $exam->course->name }}">
                <!-- Course Selection (disabled) -->
                <div class="mb-4">
                    <label  for="course" class="block text-lg text-gray-700">Course</label>
                    <select id="course" name="course" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" disabled>
                        <option value="{{ $exam->course }}" selected>{{ $exam->course->name }}</option>
                    </select>
                </div>
    
                <!-- Duration -->
                <div class="mb-4">
                    <label  class="inline-block text-lg mr-2" for="duration">Duration (minutes)</label>
                    <input data-default-value="{{ $exam->duration }}"  id="duration" name="duration" type="number" value="{{ $exam->duration }}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
    
                <!-- Questions -->
                <div class="mb-4 mt-6 questions-container">
                    <label for="questions" class="block text-gray-700 text-sm font-bold mb-2">Select Questions</label>
                    <div class="max-h-60 overflow-y-auto border border-gray-300 rounded-md">
                        @foreach($questions as $question)
                            <div class="flex items-center justify-between p-2 {{ in_array($question->id, $selectedQuestionIds) ? 'bg-gray-200' : 'hover:bg-gray-100' }} question-item">
                                <div class="flex items-center">
                                    <input type="checkbox" id="question_{{ $question->id }}" name="questions[]" value="{{ $question->id }}" class="rounded text-indigo-600 focus:ring-indigo-500" {{ in_array($question->id, $selectedQuestionIds) ? 'checked' : '' }} data-default-checked="{{ in_array($question->id, $selectedQuestionIds) ? 'true' : 'false' }}">
                                    <label for="question_{{ $question->id }}" class="ml-2 text-sm text-gray-700">
                                        <span class="text-gray-900 mr-3">
                                        ID {{ $question->id }}  : </span> {{ $question->question }}  (Course: {{ $question->course->name }}, Type: {{ $question->type }}, Difficulty: {{ $question->difficulty }})
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                


                <div class="flex justify-between">
                    <div id="selectedCount" class="mt-2 text-sm text-gray-600">
                        Selected Questions: {{ count($selectedQuestionIds) }}
                    </div>
                    <button id="resetToDefaultButton" type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Reset to Default
                    </button>
                    <button type="button" id="selectAllButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Select All Questions
                    </button>
                    </div>
    
                <!-- Start Time -->
                <div class="flex space-x-4 mt-5">
                <div class="mb-4">
                    <label class="block text-lg text-gray-700" for="start_time">Start Time</label>
                    <input type="datetime-local" id="start_time" name="start_time" value="{{ $exam->start_time->format('Y-m-d\TH:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- End Time -->
                <div class="mb-4">
                    <label class="block text-lg text-gray-700" for="end_time">End Time</label>
                    <input type="datetime-local" id="end_time" name="end_time" value="{{ $exam->end_time->format('Y-m-d\TH:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                </div>


                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Exam</button>
                    <a href="/exam" class="text-blue-500 hover:text-blue-700">Back to All Exams</a>
                </div>
            </form>
        </div>
    
        <script>
            function updateSelectedCount() {
                const selectedQuestions = document.querySelectorAll('.questions-container input[type="checkbox"]:checked').length;
                const countDisplay = document.getElementById('selectedCount');
                countDisplay.textContent = `Selected Questions: ${selectedQuestions}`;
            }
        
            function updateBackgroundOnCheckboxChange() {
                const questionsCheckboxes = document.querySelectorAll('.questions-container input[type="checkbox"]');
                questionsCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        this.closest('.question-item').classList.toggle('bg-gray-200', this.checked);
                        updateSelectedCount();
                    });
                });
            }
        
            function selectAllQuestions() {
                const questionsCheckboxes = document.querySelectorAll('.questions-container input[type="checkbox"]');
                questionsCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    checkbox.closest('.question-item').classList.add('bg-gray-200');
                });
                updateSelectedCount();
            }
        
            function resetToDefault() {
                const titleElement = document.getElementById('title');
                const durationElement = document.getElementById('duration');
                const questionsCheckboxes = document.querySelectorAll('.questions-container input[type="checkbox"]');
        
                titleElement.value = titleElement.getAttribute('data-default-value');
                durationElement.value = durationElement.getAttribute('data-default-value');
        
                questionsCheckboxes.forEach(checkbox => {
                    const defaultChecked = checkbox.getAttribute('data-default-checked') === 'true';
                    checkbox.checked = defaultChecked;
                    checkbox.closest('.question-item').classList.toggle('bg-gray-200', defaultChecked);
                });
        
                updateSelectedCount();
            }
        
            function setInitialBackground() {
                const questionsCheckboxes = document.querySelectorAll('.questions-container input[type="checkbox"]');
                questionsCheckboxes.forEach(checkbox => {
                    const isChecked = checkbox.checked;
                    checkbox.closest('.question-item').classList.toggle('bg-gray-200', isChecked);
                });
            }
        
            document.addEventListener('DOMContentLoaded', function() {
                setInitialBackground();
                updateBackgroundOnCheckboxChange();
                updateSelectedCount();
        
                document.getElementById('selectAllButton').addEventListener('click', selectAllQuestions);
                document.getElementById('resetToDefaultButton').addEventListener('click', resetToDefault);
            });
        </script>
        
</x-layout>
