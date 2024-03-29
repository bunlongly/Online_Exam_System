<x-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-6">Your Announcements</h1>

        @forelse($announcements as $announcement)
            <div class="bg-white rounded-lg shadow mb-4 overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $announcement->title }}
                    </h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>{{ $announcement->message }}</p>
                        <p class="text-xs text-gray-600">Sent by: {{ $announcement->sender->first_name }} {{ $announcement->sender->last_name }} | {{ $announcement->created_at->format('F d, Y \a\t H:i') }}</p>
                        @if($announcement->course)
                            <p class="text-xs text-gray-600">Course: {{ $announcement->course->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>No announcements to display.</p>
        @endforelse
    </div>
</x-layout>
