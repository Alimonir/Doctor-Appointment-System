<x-layout>
    <div class="flex min-h-screen flex-col justify-center items-center px-6 py-12 bg-gray-100">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
            <div class="text-center">
                <img class="mx-auto h-16 w-16 rounded-full shadow-sm" src="{{ asset('storage/logo.jpg') }}" alt="Opel">
                <h2 class="mt-4 text-2xl font-bold text-gray-900">Sign Up</h2>
            </div>

            <form class="mt-6 space-y-4" action="{{ route('register') }}" method="POST">
                @csrf 

                {{-- Username Field --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">name</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm"
                        value="{{ old('name') }}" placeholder="Enter your name">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" autocomplete="email"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm"
                        value="{{ old('email') }}" placeholder="Enter your email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" autocomplete="current-password"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm"
                        placeholder="Enter your password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password Field --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm"
                        placeholder="Confirm your password">
                </div>

                {{-- Role Selection --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                    <select name="role" id="role" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm">
                        <option value="patient">Patient</option>
                        <option value="doctor">Doctor</option>
                    </select>
                </div>
                <!-- Specialization Dropdown (Hidden by Default) -->
                <div id="specializationDiv" style="display: none;">
                    <label for="specialization" class="block text-sm font-medium text-gray-700">Select
                        Specialization</label>
                    <select name="specialization" id="specialization"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm">
                        <option value="">Select Specialization</option>
                        <option value="Cardiologist">Cardiologist</option>
                        <option value="Dermatologist">Dermatologist</option>
                        <option value="Pediatrician">Pediatrician</option>
                        <option value="Neurologist">Neurologist</option>
                        <option value="Orthopedic">Orthopedic</option>
                    </select>
                </div>
                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                        Sign Up
                    </button>
                </div>
            </form>

            {{-- Login Link --}}
            <p class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Login</a>
            </p>
        </div>
    </div>
    <script>
        document.getElementById('role').addEventListener('change', function() {

            let specializationDiv = document.getElementById('specializationDiv');

            if (this.value === 'doctor') {
                specializationDiv.style.display = 'block';
            } else {
                specializationDiv.style.display = 'none';

            }
        });
    </script>
</x-layout>
