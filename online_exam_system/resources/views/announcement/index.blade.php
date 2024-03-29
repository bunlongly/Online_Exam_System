
<x-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Announcements</h1>
            @if(auth()->user()->hasRole('teacher'))
                <a href="{{ route('announcements.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Announcement
                </a>
            @endif
        </div>

        @forelse($announcements as $announcement)
            <div class="mb-4 bg-white rounded-lg shadow overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $announcement->title }}
                    </h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>{{ $announcement->message }}</p>
                        <p class="text-xs text-gray-600">Sent on {{ $announcement->created_at->format('F d, Y \a\t H:i') }}</p>
                    </div>
                    <div class="mt-3 flex justify-between items-center">
                        @if($announcement->course)
                            <span class="text-sm font-semibold text-gray-600">Course: {{ $announcement->course->name }}</span>
                        @elseif($announcement->student)
                            <span class="text-sm font-semibold text-gray-600">Student: {{ $announcement->student->first_name }} {{ $announcement->student->last_name }}</span>
                        @endif
                        @if(auth()->user()->hasRole('teacher'))
                            <div class="flex space-x-2">
                                <a href="{{ route('announcements.edit', $announcement->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded">Edit</a>

                                <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</button>
                                </form>                                
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-700">No announcements to show.</p>
        @endforelse
    </div>
</x-layout>
