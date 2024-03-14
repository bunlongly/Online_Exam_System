<x-layout>
    v
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

        @include('partials._search')

        <!-- Exam List -->
        <div class="bg-white rounded-xl shadow-xl">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="hover:bg-gray-50">
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-lg rounded-bl-lg">
                            Exam Title
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Duration
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total Questions
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
                    <!-- Example Exam Data -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 font-bold">Web Development</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-700">120 minutes</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-700">50</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="#" class="text-blue-500 hover:text-blue-600 mr-2">Detail | </a>
                            <a href="#" class="text-blue-500 hover:text-blue-600"><i class="fas fa-edit mr-2"></i>Edit</a>
                            <a href="#" class="text-red-500 hover:text-red-600 ml-4"><i class="fas fa-trash-alt mr-2"></i>Delete</a>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <!-- Publish/Unpublish Button -->
                            <button class="text-green-600 hover:text-green-800"><i class="fas fa-upload mr-2"></i>Publish</button>
                        </td>
                    </tr>
                    
                   
                 
                </tbody>
            </table>
        </div>

        <!-- Placeholder for Pagination -->
        <div class="mt-6">
            <p class="text-center text-gray-600">Pagination Placeholder</p>
        </div>
    </div>
</x-layout>
