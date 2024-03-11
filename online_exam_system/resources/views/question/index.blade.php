<x-layout>
    <div class="flex justify-between items-center mx-4 mt-4">
        <h1 class="text-6xl">Question Bank</h1>
        <a href="question/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fa-solid fa-pen-to-square"></i>
            Create Question
        </a>
    </div>
    <div class="border border-gray-300 bg-gray-100 p-4 rounded-lg mt-4 mx-4">
        <h2 class="text-4xl mb-2 text-gray-800">Total Questions in QuestionBank:</h2>
        <p class="text-teal text-4xl font-bold">{{ $totalQuestions }}</p>
    </div>
    
  
    @include('partials._search')
    <div class="overflow-x-auto shadow-md sm:rounded-lg mx-4">
        <table class="w-full text-sm text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left">Course</th>
                    <th scope="col" class="px-6 py-3 text-left">Question</th>
                    <th scope="col" class="px-6 py-3 text-left">Type</th>
                    <th scope="col" class="px-6 py-3 text-left">Difficulty</th>
                    <th scope="col" class="px-6 py-3 text-left">Score</th>
                    <th scope="col" class="px-6 py-3 text-left">Correct Answer</th> <!-- New header for correct answer -->
                    <th scope="col" class="px-6 py-3 text-center">Options</th>
                </tr>
            </thead>
            @foreach($questions as $question)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $question->course }}</td>
                    <td class="px-6 py-4 align-top break-words max-w-lg">{{ $question->question }}</td>
                    <td class="px-6 py-4">{{ $question->type }}</td>
                    <td class="px-6 py-4">{{ $question->difficulty }}</td>
                    <td class="px-6 py-4">{{ $question->score }}</td>
                    <td class="px-6 py-4">{{ $question->correct_answer }}</td> 
                    <!-- New data tag for correct answer -->
                    <td class="px-6 py-4 text-center flex flex-col sm:flex-row justify-center items-center">
                        <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline mr-0 sm:mr-4 mb-2 sm:mb-0">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#" class="text-red-600 dark:text-red-500 hover:underline">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                    
                </tr>
            @endforeach
            
        </table> 
    </div>
</x-layout>