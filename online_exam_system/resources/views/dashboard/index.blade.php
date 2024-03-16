<x-layout>
    <div class="ml-28">
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
                  <p class="font-semibold text-blue-500 group-hover:text-white">Survey</p>
                  <p class="text-blue-500 group-hover:text-white">00</p>
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
        
        <div><p class="font-semibold ml-6">Active Exams</p></div>
        <br>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-500 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Course
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Class
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Database System
                        </th>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4">
                            20 April 2024
                        </td>
                        <td class="px-6 py-4">
                            9:00 - 11:00
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Software Requirement Engineering
                        </th>
                        <td class="px-6 py-4">
                            White
                        </td>
                        <td class="px-6 py-4">
                            21 April 2024
                        </td>
                        <td class="px-6 py-4">
                            8:30 - 10:30
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Data Structure
                        </th>
                        <td class="px-6 py-4">
                            Black
                        </td>
                        <td class="px-6 py-4">
                            21 April 2024
                        </td>
                        <td class="px-6 py-4">
                            1:30 - 3:30
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
</x-layout>