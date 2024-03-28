{{-- resources/views/admin/student-exam-history.blade.php --}}
<x-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Student Exam History</h2>
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative" style="max-height: 405px;">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100 text-gray-600 font-bold">
                            Student
                        </th>
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100 text-gray-600 font-bold">
                            Exam
                        </th>
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100 text-gray-600 font-bold">
                            Course
                        </th>
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100 text-gray-600 font-bold">
                            Teacher
                        </th>
                   
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100 text-gray-600 font-bold">
                            Score
                        </th>
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100 text-gray-600 font-bold">
                            Passed
                        </th>
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100 text-gray-600 font-bold">
                            Date Attempted
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($examAttempts as $attempt)
                        <tr>
                            <td class="py-2 px-3 border-b border-gray-200">{{ $attempt->student->first_name }} {{$attempt->student->last_name}} </td>
                            <td class="py-2 px-3 border-b border-gray-200">{{ $attempt->exam->title }}</td>
                            <td class="py-2 px-3 border-b border-gray-200">{{ $attempt->exam->course->name }}</td>
                            <td class="py-2 px-3 border-b border-gray-200">
                                @if($attempt->exam->course->teachers->isNotEmpty())
                                    {{ $attempt->exam->course->teachers->first()->first_name . ' ' . $attempt->exam->course->teachers->first()->last_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="py-2 px-3 border-b border-gray-200">{{ $attempt->score }}</td>
                            <td class="py-2 px-3 border-b border-gray-200">
                                <span class="{{ $attempt->passed ? 'text-green-500' : 'text-red-500' }} font-bold">
                                    {{ $attempt->passed ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="py-2 px-3 border-b border-gray-200">{{ $attempt->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $examAttempts->links() }}
        </div>
    </div>
</x-layout>
