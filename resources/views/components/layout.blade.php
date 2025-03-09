<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Alpine.js for interactive components --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Vite for CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- Header/Navbar --}}
    <header class="bg-gray-800 text-white p-4">
        <nav class="container mx-auto flex justify-between items-center">
            {{-- App Name --}}
            <div class="text-lg font-bold">
                <a href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>

            {{-- Navigation Links --}}
            <ul class="flex space-x-4 items-center">
                <li><a href="{{ route('home') }}" class="hover:text-gray-400">Home</a></li>
                @guest
                    <li><a href="{{ route('register') }}" class="hover:text-gray-400">Register</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-gray-400">Login</a></li>
                @endguest

                @auth
                    {{-- User Dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="flex items-center space-x-2 focus:outline-none">
                            <img src="{{ asset('./storage/logo.jpg') }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" @click.outside="open = false" 
                            class="bg-white text-black shadow-lg absolute top-12 right-0 rounded-lg overflow-hidden w-48 z-50">
                            <div class="p-4">
                                <p class="text-gray-700 font-semibold">{{ auth()->user()->username }}</p>
                                {{-- <p class="text-gray-500 text-sm">{{ auth()->user()->email }}</p> --}}
                            </div>
                            <hr>
                            <div class="w-full">
                                <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:bg-gray-200 px-4 py-2">Dashboard</a>
                            </div>
                            <form action="logout" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-200">Logout</button>
                            </form>
                            
                        </div>
                    </div>
                @endauth

              
            </ul>
        </nav>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto p-6">
        {{ $slot }}
    </main>

</body>
</html>