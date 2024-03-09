<x-layout>
    <div class="flex justify-between items-center mx-4 mt-4">
        <h1 class="text-6xl">Question Bank</h1>
        <a href="/create-question" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create Question
        </a>
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
                    <th scope="col" class="px-6 py-3 text-center">Options</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Web Development</td>
                    <td class="px-6 py-4 align-top break-words max-w-lg">Lorem Ipsum és un text de farciment usat per la indústria de la tipografia i la impremta. Lorem Ipsum ha estat el text estàndard de la indústria des de l'any 1500</td>
                    <td class="px-6 py-4">Multiple Choice</td>
                    <td class="px-6 py-4">Intermediate</td>
                    <td class="px-6 py-4">10</td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline mr-4">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <a href="#" class="text-red-600 dark:text-red-500 hover:underline">
                            <i class="fas fa-trash"></i>Delete
                        </a>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Database System</td>
                    <td class="px-6 py-4 align-top break-words max-w-lg">Lorem Ipsum és un text de farciment usat per la indústria de la tipografia i la impremta. Lorem Ipsum ha estat el text estàndard de la indústria des de l'any 1500</td>
                    <td class="px-6 py-4">True / False</td>
                    <td class="px-6 py-4">Advanced</td>
                    <td class="px-6 py-4">15</td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline mr-4">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <a href="#" class="text-red-600 dark:text-red-500 hover:underline">
                            <i class="fas fa-trash"></i>Delete
                        </a>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Software Requirement</td>
                    <td class="px-6 py-4 align-top break-words max-w-lg">Lorem Ipsum és un text de farciment usat per la indústria de la tipografia i la impremta. Lorem Ipsum ha estat el text estàndard de la indústria des de l'any 1500</td>
                    <td class="px-6 py-4">Answer the Question</td>
                    <td class="px-6 py-4">Medium</td>
                    <td class="px-6 py-4">30</td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline mr-4">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <a href="#" class="text-red-600 dark:text-red-500 hover:underline">
                            <i class="fas fa-trash"></i>Delete
                        </a>
                    </td>
                </tr>
            </tbody>
        </table> 
    </div>
</x-layout>
