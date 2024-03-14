<x-layout>

  


    <div class="flex justify-between items-center mx-4 mt-4">
        <h1 class="text-6xl text-gray-900">Question Bank</h1>
        <a href="question/create" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
            <i class="fa-solid fa-pen-to-square"></i> Create Question
        </a>
    </div>

    <div class="border border-gray-300 bg-white p-4 rounded-lg mt-4 mx-4 shadow">
        <h2 class="text-4xl mb-2 text-gray-800">Total Questions in QuestionBank: {{ $totalQuestions }}</h2>
    </div>

    @include('partials._search')

    <div class="mt-5 mx-4 flex justify-between items-center">
        <div class="bg-gray-100 p-4 rounded-lg shadow flex items-center">
            <label for="questionType" class="font-semibold text-gray-800 mr-3">Filter by Type:</label>
            <select id="questionType" onchange="location = this.value;" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-300">
                <option value="{{ route('question.index', ['type' => 'all']) }}" {{ $typeFilter == '' ? 'selected' : '' }}>All Types</option>
                <option value="{{ route('question.index', ['type' => 'Multiple Choice']) }}" {{ $typeFilter == 'Multiple Choice' ? 'selected' : '' }}>Multiple Choice</option>
                <option value="{{ route('question.index', ['type' => 'True Or False']) }}" {{ $typeFilter == 'True Or False' ? 'selected' : '' }}>True Or False</option>
                <option value="{{ route('question.index', ['type' => 'Enter the Answer']) }}" {{ $typeFilter == 'Enter the Answer' ? 'selected' : '' }}>Enter the Answer</option>
            </select>
        </div>
    </div>
    

    <div class="mt-4 mx-4">
        <div class="overflow-x-auto shadow-lg sm:rounded-lg">
            <table class="w-full text-sm text-gray-900 bg-white">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">

                <tr>
                    <th scope="col" class="px-6 py-3 text-left">Course</th>
                    <th scope="col" class="px-6 py-3 text-left">Question</th>
                    <th scope="col" class="px-6 py-3 text-left">Type</th>
                    <th scope="col" class="px-6 py-3 text-left">Difficulty</th>
                    <th scope="col" class="px-6 py-3 text-left">Score</th>
                    <th scope="col" class="px-6 py-3 text-left">Correct Answer</th>
                    <th scope="col" class="px-6 py-3 text-left">User</th>
                    <th scope="col" class="px-6 py-3 text-left">Details</th>
                    <th scope="col" class="px-6 py-3 text-center">Options</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($questions as $question)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $question->course }}</td>
                        <td class="px-6 py-4 max-w-lg">{{ $question->question }}</td>
                        <td class="px-6 py-4">{{ $question->type }}</td>
                        <td class="px-6 py-4">{{ $question->difficulty }}</td>
                        <td class="px-6 py-4">{{ $question->score }}</td>
                        <td class="px-6 py-4">
                            @if($question->type == 'Multiple Choice')
                                @php
                                    $options = json_decode($question->options, true);
                                    $correctOption = $options[$question->correct_answer] ?? 'N/A';
                                @endphp
                                <div class="text-sm text-green-600">
                                    <span class="font-semibold">{{ $question->correct_answer }}:</span>
                                    <span>{{ $correctOption }}</span>
                                </div>
                            @else
                                <div class="text-sm text-green-600">{{ $question->correct_answer }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $question->user->name }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('question.show', $question) }}" class="text-blue-600 hover:text-blue-800">
                                Details
                            </a>
                        </td>
                        <td class="px-6 py-4 align-middle text-center">
                            <div class="inline-flex flex-col sm:flex-row justify-center items-center space-y-2 sm:space-y-0 sm:space-x-4">
                                <a href="/question/{{$question->id}}/edit" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('question.destroy', $question->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this question?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <div class="m-6">
            {{ $questions->links() }}
        </div>
    </div>

</x-layout>
