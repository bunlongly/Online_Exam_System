<x-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800">Exam Details: {{ $exam->title }}</h1>
            <div>
                <a href="{{ route('dashboard.index') }}" class="text-blue-500 hover:text-blue-700 font-bold">Back to Dashboard</a>
                <br/>
                <a href="{{ route('exam.index') }}" class="text-blue-500 hover:text-blue-700 font-bold mr-4">Back to Exam Dashboard</a>
            </div>
        </div>
        

     

        <!-- Exam Information -->
        <div class="bg-white rounded-xl shadow-xl p-6 mt-4">
            <div class="grid grid-cols-2 gap-4">
                <div><p class="text-lg"><strong>Title:</strong> {{ $exam->title }}</p></div>
                <div><p class="text-lg"><strong>Course:</strong> {{ $exam->course }}</p></div>
                <div><p class="text-lg"><strong>Duration:</strong> {{ $exam->duration }} minutes</p></div>
                <div><p class="text-lg"><strong>Total Questions:</strong> {{ $exam->questions->count() }}</p></div>
                <div><p class="text-lg"><strong>Total Score:</strong> {{ $totalScore }}</p></div>
                <div><p class="text-lg"><strong>Created By: </strong>   {{ $exam->user->name ?? 'Unknown' }}</p></div>
            </div>
        </div>

        <!-- Publication Status and Exam Times -->
        <div class="flex justify-between items-center mt-3">
            <p class="text-lg font-bold">Status: 
                <span class="status-text {{ $exam->published ? 'text-green-600' : 'text-red-600' }} font-semibold">
                    <i class="status-icon {{ $exam->published ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                    {{ $exam->published ? 'Published' : 'Unpublished' }}
                </span>
            </p>
            
            <div class="flex">
                <p class="text-lg"><strong>Start Time:</strong> {{ $exam->start_time->format('d/m/Y H:i') }}</p>
                <p>------</p>
                <p class="text-lg"><strong>End Time:</strong> {{ $exam->end_time->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Timer -->
        <div id="exam-timer" class="text-xl font-bold text-red-600">
            <!-- Timer will be displayed here -->
        </div>

        <!-- Questions List -->
        <div class="bg-white rounded-xl shadow-xl p-6 mt-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Questions:</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Question</th>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Difficulty</th>
                            <th class="px-4 py-2">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 font-semibold">{{ $question->id }}</td>
                                <td class="px-4 py-2">{{ $question->question }}</td>
                                <td class="px-4 py-2">{{ $question->type }}</td>
                                <td class="px-4 py-2">{{ $question->difficulty }}</td>
                                <td class="px-4 py-2">{{ $question->score }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $questions->links() }}
            </div>
        </div>
    
            <!-- Action Buttons -->
            <div class="mt-4 space-x-4">
                <a href="{{ route('exam.edit', $exam)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">Edit Exam</a>
                <form action="{{route('exam.destroy', $exam)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this exam?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">Delete Exam</button>
                </form>
                <button id="publishButton" type="button" 
                onclick="confirmTogglePublish(event, {{ $exam->id }}, {{ $exam->published ? 'true' : 'false' }});" 
                class="text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300 
                {{ $exam->published ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }}">
            {{ $exam->published ? 'Unpublish' : 'Publish' }}
                </button>
            </div>
    
        </div>
    
    <script>
    let examId = {{ json_encode($exam->id) }};
    let isPublished = {{ json_encode($exam->published) }};
    let remainingTime = {{ json_encode($exam->published ? ($exam->duration * 60 - now()->diffInSeconds($exam->start_time)) : 0) }};
    let timerInterval = null;

    document.addEventListener('DOMContentLoaded', function() {
        updateStatusAndButton(isPublished);
        if (isPublished && remainingTime > 0) {
            startTimer(remainingTime);
        }
    });

    function confirmTogglePublish(event, examId, isCurrentlyPublished) {
        if (confirm(`Are you sure you want to ${isCurrentlyPublished ? 'unpublish' : 'publish'} this exam?`)) {
            togglePublishAndPreventDefault(event, examId);
        }
    }

    function togglePublishAndPreventDefault(event, examId) {
    if (event) {
        event.preventDefault();
    }

    fetch(`/exam/toggle-publish/${examId}`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        updateStatusAndButton(data.published);
        if (data.published && data.remainingTime > 0) {
            startTimer(data.remainingTime);
        } else {
            stopTimer();
        }
        // Refresh the page
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        // Optionally, handle the error in the UI here
    });
}


    function updateStatusAndButton(currentlyPublished) {
        console.log("Updating status and button", currentlyPublished); // Debugging log
        isPublished = currentlyPublished;
        let publishButton = document.getElementById('publishButton');
        let statusTextElement = document.querySelector('.status-text');
        let statusIconElement = document.querySelector('.status-icon');

        if (publishButton && statusTextElement && statusIconElement) {
            publishButton.textContent = isPublished ? 'Unpublish' : 'Publish';
            publishButton.className = isPublished ? 'bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded' : 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded';

            statusTextElement.textContent = isPublished ? 'Published' : 'Unpublished';
            statusIconElement.className = isPublished ? 'fas fa-check-circle text-green-600' : 'fas fa-times-circle text-red-600';
        }
    }
        
            function stopTimer() {
                const timerElement = document.getElementById('exam-timer');
                if(timerInterval) {
                    clearInterval(timerInterval);
                }
                timerElement.textContent = 'Timer Stopped';
            }
        
            function startTimer(duration) {
                const timerElement = document.getElementById('exam-timer');
                let time = duration;
                timerInterval = setInterval(() => {
                    const minutes = Math.floor(time / 60);
                    const seconds = time % 60;
                    timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
                    if (time-- <= 0) {
                        clearInterval(timerInterval);
                        timerElement.textContent = 'TIME UP';
                    }
                }, 1000);
            }
        </script>
        
</x-layout>
