<form action="{{ route('question.index') }}" method="GET">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
        </div>
        <input
            type="text"
            name="search"
            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
            placeholder="Search Questions..."
            value="{{ request('search') }}"
        />
        <div class="absolute top-2 right-2">
            <button style="background-color:#282828"
                type="submit"
                class="h-10 w-20 text-white rounded-lg hover:bg-black-600">
                Search
            </button>
        </div>
    </div>
</form>
