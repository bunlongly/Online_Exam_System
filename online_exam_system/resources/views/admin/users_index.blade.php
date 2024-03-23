<x-layout>
    <div class="flex justify-between items-center mx-4 mt-4">
        <h1 class="text-6xl text-gray-900">Users</h1>
        <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-300">
            <i class="fa-solid fa-user-plus"></i> Create User
        </a>
    </div>

    <div class="mt-4 mx-4">
        <div class="overflow-x-auto shadow-lg sm:rounded-lg">
            <table class="w-full text-sm text-gray-900 bg-white">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left">ID</th>
                        <th scope="col" class="px-6 py-3 text-left">Name</th>
                        <th scope="col" class="px-6 py-3 text-left">Email</th>
                        <th scope="col" class="px-6 py-3 text-left">Role</th>
                        <th scope="col" class="px-6 py-3 text-left">Details</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $user->unique_id }}</td>
                            <td class="px-6 py-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @foreach($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                <a href="" class="text-blue-600 hover:text-blue-800">
                                    Details
                                </a>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 ml-2">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="m-6">
            {{ $users->links() }}
        </div>
    </div>
</x-layout>
