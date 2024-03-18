<x-layout>
    <div class="container mx-auto">
        <div class="container ">
          <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col gap-4 place-content-around h-48">
              <div class="bg-blue-700 p-4 text-white rounded-lg transition ease-in-out delay-150 border-blue-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-100 hover:bg-blue-600 duration-300">
                <p class="font-semibold">Active Exam Takers</p>
                <p>5</p>
              </div>
              <div class="bg-blue-700 p-4 text-white rounded-lg transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-100 hover:bg-blue-600 duration-300">
                <p class="font-semibold">Active Exams</p>
                <p>3</p>
              </div>
            </div>
          
            <div class="bg-blue-800 p-4 rounded-md text-white transition ease-in-out delay-150 border-blue-500 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-100 hover:bg-blue-600 duration-300">
              <p class="font-semibold">Courses</p>
              <p>Total: 4</p>
              <br>
              <div class="grid gap-x-8 gap-y-4 grid-cols-2">
                <div>Database System</div>
                <div>Software Requirements</div>
                <div>Data Structure</div>
                <div>Mobile Programming</div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="grid grid-cols-4 gap-4">
                <div class="group bg-transparent p-4 rounded-md border-2 transition ease-in-out delay-150 border-blue-500 hover:-translate-y-1 hover:scale-100 hover:bg-blue-500 duration-300">
                  <p class="font-semibold text-blue-500 group-hover:text-white">Total Exams</p>
                  <p class="text-blue-500 group-hover:text-white">05</p>
                </div>
        
                <div class="group bg-transparent p-4 rounded-md border-2 transition ease-in-out delay-150 border-blue-500 hover:-translate-y-1 hover:scale-100 hover:bg-blue-500 duration-300">
                  <p class="font-semibold text-blue-500 group-hover:text-white">Questions</p>
                  <p class="text-blue-500 group-hover:text-white">25</p>
                </div>              
          
              
                <div class="group bg-transparent p-4 rounded-md border-2 transition ease-in-out delay-150 border-blue-500 hover:-translate-y-1 hover:scale-100 hover:bg-blue-500 duration-300">
                    <p class="font-semibold text-blue-500 group-hover:text-white">Average Exam Scores</p>
                    <p class="text-blue-500 group-hover:text-white">78%</p> <!-- Example percentage -->
                </div>
         
                <div class="group bg-transparent p-4 rounded-md border-2 transition ease-in-out delay-150 border-blue-500 hover:-translate-y-1 hover:scale-100 hover:bg-blue-500 duration-300">
                  <p class="font-semibold text-blue-500 group-hover:text-white">Students</p>
                  <p class="text-blue-500 group-hover:text-white">20</p>
                </div>
              </div>
            </div>
          </div>
        </div>
          </div>
          <br><br>
        
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
                                      <p class="text-gray-900 font-bold">{{ $exam->course }}</p>
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



