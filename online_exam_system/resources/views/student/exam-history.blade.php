<x-layout>
    <div class="container mx-auto px-4 sm:px-8 max-w-4xl">
        <h1 class="text-3xl font-semibold leading-tight text-gray-800 mb-6 mt-4 text-center">Exam History</h1>
        <div class="my-2">
            @forelse($examAttempts as $attempt)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Exam Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Course
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Teachers
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date Taken
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Score
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $attempt->exam->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $attempt->exam->course->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @foreach($attempt->exam->course->teachers as $teacher)
                                        {{ $teacher->first_name }} {{ $teacher->last_name }}@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $attempt->attempt_date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $attempt->score }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $attempt->passed ? 'Passed' : 'Failed' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-xl text-gray-700">No exam history available.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
