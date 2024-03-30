<x-layout>
        <div class="container mx-auto p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-center">
                <!-- Course Names -->
                <div class="col-span-1 lg:col-span-3 bg-blue-800 text-white rounded-lg p-4 shadow-lg">
                    <h3 class="font-semibold text-xl mb-4">Courses</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($courses as $course)
                            <div class="hover:text-blue-300 transition-colors duration-200">
                                {{ $course->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
                
    
                <!-- Total Exams -->
                <div class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-4 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                    <p class="font-semibold">Total Exams</p>
                    <p>{{ $totalExams }}</p>
                </div>
    
                <!-- Total Questions -->
                <div class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-4 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 lg:col-span-2">
                    <p class="font-semibold">Total Questions</p>
                    <p>{{ $totalQuestions }}</p>
                </div>
    
                <!-- Total Students -->
                <div class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-4 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 lg:col-span-2">
                    <p class="font-semibold">Total Students</p>
                    <p>{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
  
    
        
          <div><p class="font-semibold text-xl ml-6 mt-8 mb-4">Active Exams</p></div>
    
          <div class="bg-white rounded-ls shadow-xl m-5">
              <table class="min-w-full leading-normal">
                  <thead>
                      <tr class="hover:bg-gray-50 bg-gray-100">
                          <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Exam Title
                          </th>
                          <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Course
                          </th>
                          <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Duration
                          </th>
                          <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Total Questions
                          </th>
                          <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Start Time
                        </th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            End Time
                        </th>
                          <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Status
                          </th>
                          <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Details
                          </th>
                          <th class="px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                              Action
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($exams as $exam)
                          @if($exam->added_to_dashboard)
                              <tr class="hover:bg-gray-50">
                                  <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                      <p class="text-gray-900 font-bold">{{ $exam->title }}</p>
                                  </td>
                                  <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                      <p class="text-gray-900 font-bold">{{ $exam->course->name }}</p>
                                  </td>
                                  <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                      <p class="text-gray-700">{{ $exam->duration }} minutes</p>
                                  </td>
                                  <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                      <p class="text-gray-700">{{ $exam->questions->count() }}</p>
                                  </td>
                                  <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    {{ $exam->start_time->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    {{ $exam->end_time->format('d/m/Y H:i') }}
                                </td>
                                  <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                      <span class="{{ $exam->published ? 'text-green-600' : 'text-red-600' }} font-bold">
                                          {{ $exam->published ? 'Published' : 'Unpublished' }}
                                      </span>
                                  </td>
                                  <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                      <a href="{{ route('exam.show', $exam) }}" class="text-blue-500 hover:text-blue-600 mr-2">View Details</a>
                                  </td>
                                  <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                      <form action="{{ route('dashboard.remove', $exam) }}" method="POST">
                                          @csrf
                                          @method('PATCH')
                                          <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                              Remove from Dashboard
                                          </button>
                                      </form>
                                  </td>
                              </tr>
                          @endif
                      @endforeach
                      @if($exams->isEmpty())
                          <tr>
                              <td colspan="7" class="px-6 py-4 text-center text-gray-500">No exams found</td>
                          </tr>
                      @endif
                  </tbody>
              </table>
               <!-- Pagination Links -->
            <div class="mt-4">
                {{ $exams->links() }}
            </div>
          </div>
</x-layout>



