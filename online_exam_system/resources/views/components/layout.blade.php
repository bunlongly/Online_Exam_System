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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.4.0/dist/flowbite.js"></script>

    <link rel="stylesheet" href="{{ asset('css/.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#282828", 
                        teal: "#1ba098", 
                    },
                },
            },
        };
    </script>
    <title>Online Exam System - Limkokwing University</title>
</head>
<body class="mb-48">

<!-- Sidebar starts here -->
@auth
<div x-cloak x-data="sidebar()" class="relative flex items-start">
    <div class="fixed top-0 z-40 transition-all duration-300">
        <div class="flex justify-end">
            <button @click="sidebarOpen = !sidebarOpen" :class="{'hover:bg-gray-300': !sidebarOpen, 'hover:bg-gray-700': sidebarOpen}" class="transition-all duration-300 w-8 h-8 p-1 mx-3 my-2 rounded-full focus:outline-none  text-teal">
                <svg viewBox="0 0 20 20" class="w-6 h-6 fill-current" :class="{'text-teal': !sidebarOpen, 'text-teal': sidebarOpen}">
                    <path x-show="!sidebarOpen" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="sidebarOpen" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    <div style="background-color: #282828; opacity:0.9;" x-cloak wire:ignore :class="{'w-64': sidebarOpen, 'w-0': !sidebarOpen}" class="fixed top-0 bottom-0 left-0 z-30 block h-full min-h-screen overflow-y-auto text-gray-400 transition-all duration-300 ease-in-out shadow-lg overflow-x-hidden">
        <div class="flex flex-col items-stretch justify-between h-full">
            <div class="flex flex-col flex-shrink-0 w-full">
                <div class="flex items-center justify-center px-8 py-3 text-center">
                    <img src="{{ asset('images/lim.png') }}" alt="Limkokwing University Logo" class="w-28"/>
                </div>
                <nav class="flex-grow">
                    <ul class="text-white text-xl">
                        <li class="my-2">
                            <a href="/" class="flex items-center text-center px-6 py-2 hover:bg-teal   hover:text-white rounded transition duration-300">
                                <i class="fas fa-home mr-2 "></i> Dashboard
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/" class="flex items-center px-6 py-2 hover:bg-teal hover:text-white rounded transition duration-300">
                                <i class="fas fa-pen mr-2 "></i> Exam
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/question" class="flex items-center px-6 py-2 hover:bg-teal  hover:text-white rounded transition duration-300">
                                <i class="fas fa-folder mr-2"></i> Question Bank
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/" class="flex items-center px-6 py-2 hover:bg-teal hover:text-white rounded transition duration-300">
                              
                                <i class="fa-solid fa-message mr-2 "></i> Announcement
                            </a>
                        </li>
                        <li class="my-2">
                            <a href="/" class="flex items-center px-6 py-2 hover:bg-teal hover:text-white rounded transition duration-300">
                              
                                <i class="fas fa-graduation-cap mr-2 "></i> Student
                            </a>
                        </li>
                       
                    </ul>
                </nav>
            </div>
            
            <div class="px-6 py-4">
                <a href="/" class="block text-white hover:text-teal  transition duration-300">
                    <i class="fa-solid fa-gear mr-2 mb-4"></i>Admin Page 
                </a>
                <a href="/" class="block text-white hover:text-teal transition duration-300">
                    <i class="fas fa-user mr-2 mb-4"></i>{{auth()->user()->name}} Profile 
                </a>
                <a href="/logout" class="text-white hover:text-red-500 transition duration-300">
                    <i class="fas fa-sign-out-alt mr-4"></i>Logout
                </a>
            </div>
        </div>
    </div>
    
</div>
@endauth
<!-- Sidebar ends here -->


<nav class="flex justify-between items-center m-4 mr-3">
    <div class="flex-initial">
        <!-- Left side of the nav, you can add logo or other elements here -->
    </div>
    <ul class="flex space-x-6 text-lg">
        @auth
            <li><span class="font-bold uppercase">Welcome {{auth()->user()->name}}</span></li>
            {{-- <li>
                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button class="hover:text-red-500"><i class="fa-solid fa-door-closed "></i> Logout</button>
                </form>
            </li> --}}
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-teal dark:focus:ring-teal" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="{{asset('images/user.png')}}" alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-teal rounded-lg shadow dark:bg-laravel dark:divide-laravel" id="user-dropdown">
                  <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">{{auth()->user()->name}}</span>
                    <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{auth()->user()->email}}</span>
                  </div>
                  <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal dark:hover:bg-gray-teal dark:text-gray-200 dark:hover:text-white">Profile</a>
                    </li>
                    <li>
                      <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal dark:hover:bg-gray-teal dark:text-gray-200 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                      <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal dark:hover:bg-red-500 dark:text-gray-200 dark:hover:text-white">Logout</a>
                    </li>
                  </ul>
                </div>
        @else
            <li><a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a></li>
            <li><a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a></li>
        @endauth
    </ul>
    
</nav>


<main>
    {{$slot}}
</main>

<footer style="background-color: #282828;" class="fixed bottom-0 left-0 w-full inline-flex items-center justify-between font-bold text-white h-24 px-4 lg:px-10 flex-nowrap">
    <img src="{{ asset('images/lim.png') }}" alt="Limkokwing University Logo" class="w-24 lg:w-28"/>
    <p class="text-sm lg:text-base text-center flex-grow">Copyright &copy; 2024, All Rights reserved</p>
    <a  href="/" class="bg-laravel text-white py-2 px-3 lg:px-5 rounded text-sm lg:text-sm">Home Page</a>
</footer>



<x-flash-message/>

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
</body>
</html>
