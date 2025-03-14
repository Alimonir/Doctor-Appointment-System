<x-master> 

    {{-- toster --}}
    
    

<h2 class="text-2xl font-bold mb-4 text-gray-800">Appointments</h2>
{{-- appoinments --}}
    <div class="overflow-x-auto mt-4">
        <table class="w-full border-collapse border border-gray-200 shadow-sm rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="border p-3 text-left">Doctor</th>
                    <th class="border p-3 text-left">Date & Time</th>
                    <th class="border p-3 text-left">Status</th>
                    @can('edit_appointment')
                        <th class="border p-3 text-left">Actions</th>
                    @endcan
                    <th class="border p-3 text-left">Available time</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border p-3">
                            <span class="font-medium text-gray-800">{{ $appointment->user->name }}</span>
                            <span class="text-sm text-gray-600 block">{{ $appointment->user->doctor->specialization }}</span>
                        </td>
                        <td class="border p-3 text-gray-700">{{ $appointment->appointment_time }}</td>
                        <td class="border p-3">
                            <span class="px-2 py-1 rounded text-white 
                                {{ $appointment->status === 'approved' ? 'bg-green-500' : ($appointment->status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="border p-3">
                            {{-- delete appointment --}}
                            @can('delete_appointment')
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                                    Delete
                                </button>
                            </form>
                            @endcan
                            
                        </td>

                        @can('edit_appointment')
                            <td class="border p-3 flex gap-2">
                                @if ($appointment->status === 'pending')
                                    <form action="{{ route('appointments.approve', $appointment->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('appointments.rejected', $appointment->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                                            Reject
                                        </button>
                                    </form>
                                @endif
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   @can('create_slot')
       
    {{-- slots --}}
    <div class="mt-6">
        <h1 class="text-2xl font-bold mb-6">Available Slots</h1>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Start Time</th>
                    <th scope="col" class="px-6 py-3">End Time</th>
                    <th scope="col" class="px-6 py-3">User</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($slots as $slot)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{$slot->start_at}}</td>
                    <td class="px-6 py-4">{{$slot->end_at}}</td>
                    <td class="px-6 py-4">{{$slot->user->name}}</td>
                    <td class="px-6 py-4">
                        <a href="{{route('slots.edit', $slot->id)}}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">Edit</a>
                        <form action="{{route('slots.destroy', $slot->id)}}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endcan

     {{-- doctors --}}
     <div class="mt-6">
        <h1 class="text-2xl font-bold mb-6">Doctors</h1>
        <table class="w-full border-collapse border border-gray-200 shadow-sm rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                <th class="border p-3 text-left">Doctor</th>
                <th class="border p-3 text-left">Specialization</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 ">
            @foreach ($doctors as $doctor)
                <tr class="hover:bg-gray-50 transition">
                    <td class="border p-3">Dr : {{ $doctor->name }}</td>
                    <td class="border p-3">{{ $doctor->doctor->specialization }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    
    </div>
</x-master> 
