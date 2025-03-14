<x-simpleheader>
    <div class="flex min-h-screen items-center justify-center bg-gray-100 px-6 py-12">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
            <div class="text-center">
                <img class="mx-auto h-16 w-16 rounded-full shadow-md" src="{{ asset('storage/logo.jpg') }}" alt="Opel">
                <h2 class="mt-4 text-2xl font-bold text-gray-900">Sign in to your account</h2>
            </div>

            {{-- Form --}}
            <form class="mt-6 space-y-4" action="{{ route('login') }}" method="POST">
                @csrf {{-- Protects against CSRF attacks --}}
                
                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" autocomplete="email" 
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm"
                        value="{{ old('email') }}" placeholder="Enter your email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                    <input type="password" name="password" id="password" autocomplete="current-password"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm"
                        placeholder="Enter your password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                        Sign in
                    </button>
                </div>
            </form>

            {{-- Register Link --}}
            <p class="mt-6 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Register</a>
            </p>
        </div>
    </div>
</x-simpleheader>
