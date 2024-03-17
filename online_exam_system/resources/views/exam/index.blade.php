<x-layout>
    
    </div>
    <div class="container mx-auto p-6">
        <div class="mb-4">
            <h1 class="text-4xl font-bold text-gray-800">Exam Dashboard</h1>
        </div>

        <!-- Action Buttons -->
        <div class="mb-6 text-right">
            <a href="/exam/create" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">
                <i class="fas fa-plus-circle mr-2"></i>Create New Exam
            </a>
        </div>


        <!-- Exam List -->
        <div class="bg-white rounded-xl shadow-xl">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="hover:bg-gray-50">
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-lg rounded-bl-lg">
                            Exam Title
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-lg rounded-bl-lg">
                            Exam course
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Duration
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total Questions
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-lg rounded-br-lg">
                            Details
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-lg rounded-br-lg">
                            Actions
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $exam)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 font-bold">{{ $exam->title }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 font-bold">{{ $exam->course }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-700">{{ $exam->duration }} minutes</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-700">{{ $exam->questions->count() }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('exam.show', $exam) }}" class="text-blue-500 hover:text-blue-600 mr-2">Detail</a>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <a href="{{ route('exam.edit', $exam)}}" class="text-blue-500 hover:text-blue-600 ml-2"><i class="fas fa-edit"></i>Edit</a>
                          
                            <form class="inline" action="{{ route('exam.destroy', $exam) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this exam?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 ml-2">
                                    <i class="fas fa-trash-alt mr-2"></i>Delete
                                </button>
                            </form>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <form class="inline" action="{{ route('exam.toggle-publish', $exam) }}" method="POST" onsubmit="return confirm('Are you sure you want to {{ $exam->published ? 'unpublish' : 'publish' }} this exam?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="{{ $exam->published ? 'text-red-500 hover:text-red-600' : 'text-green-600 hover:text-green-800' }}">
                                    <i class="fas fa-{{ $exam->published ? 'minus-circle' : 'upload' }} mr-2"></i>{{ $exam->published ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                 
                </tbody>
            </table>
        </div>

        <div class="m-6">
            {{ $exams->links() }}
        </div>
    </div>
</x-layout>
