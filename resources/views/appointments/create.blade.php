<x-layout>
<form action="{{route('appointments.store')}}" method="post">
    @csrf
    
   
    <div class="mb-4">
        <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
        <select name="doctor_id" id="doctor_id"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }} {{$doctor->doctor->specialization}}</option>
            @endforeach
        </select>
        @error('doctor_id')
            <div class="text-red-500 mt-2 text-sm">
                {{ 'Select your Doctor' }}
            </div>            
        @enderror
    </div>
    <div class="mb-4">
        <label for="appointment_time" class="block text-sm font-medium text-gray-700">Appointment Time</label>
        <input type="datetime-local" name="appointment_time" id="appointment_time" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @error('appointment_time')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>            
        @enderror
    </div>
    <div class="mb-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Book Appointment</button>
    </div>

</form>
</x-layout>