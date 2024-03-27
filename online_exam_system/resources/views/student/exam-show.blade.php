<x-layout>
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">{{ $exam->title }}</h1>
        
     
         <!-- Displaying Exam Types and Difficulties -->
         <div class="text-center mb-6">
            <p class="text-lg"><strong>Duration:</strong> {{ $exam->duration }} minutes</p>
            <p class="text-lg"><strong>Types:</strong> {{ implode(', ', $types->toArray()) }}</p>
            <p class="text-lg"><strong>Difficulties:</strong> {{ implode(', ', $difficulties->toArray()) }}</p>
        </div>

        <div id="exam-timer" class="mb-6 text-center text-2xl font-semibold text-red-600">Time left: 00:00:00</div>

        <form id="exam-form" action="{{ route('exams.submit', $exam) }}" method="POST" class="space-y-6">
            @csrf
            @foreach ($questions as $question)
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-xl font-semibold mb-4">{{ $question->question }}</p>
                    @if ($question->type === 'Multiple Choice')
                        <div class="space-y-2">
                            @foreach (json_decode($question->options, true) as $optionKey => $optionValue)
                                <label class="block">
                                    <input type="radio" id="option_{{ $question->id }}_{{ $optionKey }}" name="answers[{{ $question->id }}]" value="{{ $optionKey }}" class="mr-2">
                                    {{ $optionValue }}
                                </label>
                            @endforeach
                        </div>
                    @elseif ($question->type === 'True Or False')
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="radio" id="true_{{ $question->id }}" name="answers[{{ $question->id }}]" value="True" class="mr-2">
                                True
                            </label>
                            <label class="flex items-center">
                                <input type="radio" id="false_{{ $question->id }}" name="answers[{{ $question->id }}]" value="False" class="mr-2">
                                False
                            </label>
                        </div>
                    @elseif ($question->type === 'Enter the Answer')
                        <input type="text" id="answer_{{ $question->id }}" name="answers[{{ $question->id }}]" placeholder="Enter your answer" class="w-full border border-gray-300 rounded p-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @endif
                </div>
            @endforeach

         
            <!-- Pagination Controls -->
            <div class="flex justify-between items-center mt-4">
                @if ($currentPage > 1)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}" class="btn">Previous</a>
                @else
                    <!-- Don't show Previous button on the first page -->
                    <div></div> <!-- This keeps the Next button aligned to the right -->
                @endif
            
                <span>Page {{ $currentPage }} of {{ $totalPages }}</span>
            
                @if ($currentPage < $totalPages)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}" class="btn">Next</a>
                @else
                    <!-- Don't show Next button on the last page -->
                    <div></div> <!-- This keeps the space even on the navigation bar -->
                @endif
            </div>
            
            <div class="text-center">
                @if ($currentPage == $totalPages)
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300" onclick="return confirm('Are you sure you want to submit?');">
                        Submit Exam
                    </button>
                @endif
            </div>
        
        </form>
    </div>
    <script>
        let currentPage = {{ $currentPage }};
        let examId = {{ $exam->id }};
        
        function changePage(step) {
            currentPage += step;
            window.location.href = `/student/exam/show/${examId}?page=${currentPage}`;
        }


        // Local Storage Logic for Saving Answers
        // Updated to reset storage upon form submission
        document.getElementById('exam-form').addEventListener('submit', () => {
            localStorage.clear(); // Clears local storage when form is submitted
        });
   
    // LocalStorage to keep track of answers
    window.onload = () => {
    document.querySelectorAll('[name^="answers"]').forEach(input => {
        const name = input.name;
        const storedValue = localStorage.getItem(name);

        if (storedValue) {
        if (input.type === 'checkbox') {
            // If it's a checkbox, restore the checked state based on its value
            input.checked = storedValue === 'true';
        } else if (input.type === 'radio') {
            // If it's a radio button, check if its value matches and set checked
            input.checked = input.value === storedValue;
        } else {
            // For other input types like text
            input.value = storedValue;
        }
        }

        input.addEventListener('change', (e) => {
        if (input.type === 'checkbox') {
            // Store 'true' or 'false' for checkbox
            localStorage.setItem(name, input.checked);
        } else {
            // Store the value for other types
            localStorage.setItem(name, e.target.value);
        }
        });
    });
    };


        // Timer Logic
        let endTime = new Date("{{ $endTime->format('Y-m-d\TH:i:s') }}").getTime();
        let serverNow = new Date("{{ now()->format('Y-m-d\TH:i:s') }}").getTime();
        let remainingTime = endTime - serverNow;

        function updateTimer() {
            remainingTime -= 1000;
            if (remainingTime < 0) {
                clearInterval(timerInterval);
                document.getElementById("exam-timer").innerHTML = "TIME UP";
                document.getElementById("exam-form").submit();
                return;
            }

            // Time display logic
            let hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            document.getElementById("exam-timer").innerHTML = `Time left: ${hours}h ${minutes}m ${seconds}s`;
        }

        let timerInterval = setInterval(updateTimer, 1000);
        updateTimer();
    </script>
    
</x-layout>
