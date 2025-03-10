<x-layout>
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Appointments</h2>
   @can('create_appointment')
       <a href="{{ route('appointments.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
            Book Appointment
        </a>
   @endcan
    @can('edit_appointment')
    <a href="{{ route('slots.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
        View Appointment
    </a>
    @endcan
    
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
                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                                    Delete
                                </button>
                            </form>
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
</x-layout>
