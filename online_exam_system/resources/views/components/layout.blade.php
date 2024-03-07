<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#000000",
                    },
                },
            },
        };
    </script>
    <title>Online Exam System - Limkokwing University</title>
</head>
<body class="mb-48">

<!-- Sidebar starts here -->
<div x-cloak x-data="sidebar()" class="relative flex items-start">
    <div class="fixed top-0 z-40 transition-all duration-300">
        <div class="flex justify-end">
            <button @click="sidebarOpen = !sidebarOpen" :class="{'hover:bg-gray-300': !sidebarOpen, 'hover:bg-gray-700': sidebarOpen}" class="transition-all duration-300 w-8 h-8 p-1 mx-3 my-2 rounded-full focus:outline-none  text-white">
                <svg viewBox="0 0 20 20" class="w-6 h-6 fill-current" :class="{'text-gray-600': !sidebarOpen, 'text-gray-300': sidebarOpen}">
                    <path x-show="!sidebarOpen" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="sidebarOpen" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    <div x-cloak wire:ignore :class="{'w-56': sidebarOpen, 'w-0': !sidebarOpen}" class="fixed top-0 bottom-0 left-0 z-30 block w-56 h-full min-h-screen overflow-y-auto text-gray-400 transition-all duration-300 ease-in-out bg-black shadow-lg overflow-x-hidden ">

        <div class="flex flex-col items-stretch justify-between h-full">
            <div class="flex flex-col flex-shrink-0 w-full">
                <div class="flex items-center justify-center px-8 py-3 text-center">
                    <img src="{{ asset('images/lim.png') }}" alt="Limkokwing University Logo" class="w-28"/>
                </div>
                <nav>
                    <div class="flex-grow md:block md:overflow-y-auto overflow-x-hidden" :class="{'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen}">
                        <!--  navigation links go here -->
                    </div>
                </nav>
            </div>
            <div>
                {{-- <h1>Logout</h1> --}}
            </div>
        </div>
    </div>

    <script>
        function sidebar() {
            return {
                sidebarOpen: false,
                openSidebar() {
                    this.sidebarOpen = true
                },
                closeSidebar() {
                    this.sidebarOpen = false
                },
            }
        }
    </script>
</div>
<!-- Sidebar ends here -->

<nav class="flex justify-between items-center m-4 mr-3">
    <div class="flex-initial">
        <!-- Left side of the nav, you can add logo or other elements here -->
    </div>
    <ul class="flex space-x-6 text-lg">
        @auth
            <li><span class="font-bold uppercase">Welcome {{auth()->user()->name}}</span></li>
            <li><a href="/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage Student</a></li>
            <li>
                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button><i class="fa-solid fa-door-closed"></i> Logout</button>
                </form>
            </li>
        @else
            <li><a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a></li>
            <li><a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a></li>
        @endauth
    </ul>
</nav>

<main>
    {{$slot}}
</main>

<footer class="fixed bottom-0 left-0 w-full flex items-center justify-between font-bold bg-black text-white h-24 px-10 opacity-90">
    <img src="{{ asset('images/lim.png') }}" alt="Limkokwing University Logo" class="w-28"/>
    <p class="text-center flex-grow">Copyright &copy; 2024, All Rights reserved</p>
    <a href="/" class="bg-laravel text-white py-2 px-5 rounded">Home Page</a>
</footer>

<x-flash-message/>

</body>
</html>
