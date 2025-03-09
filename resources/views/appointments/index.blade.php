

<x-layout>
    <h2 class="text-2xl font-bold mb-4">Appointments</h2>
    <a href="{{ route('appointments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Book Appointment</a>
    <table class="w-full mt-4 border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Doctor</th>
                <th class="border p-2">Date & Time</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td class="border p-2">
                        {{ $appointment->user->name }} 
                        {{ $appointment->user->doctor->specialization }} 
                    </td>
                    <td class="border p-2">{{ $appointment->appointment_time }}</td>
                    <td class="border p-2">{{ $appointment->appointment_time }}</td>
                    <td class="border p-2">{{ ucfirst($appointment->status) }}</td>
                    <td class="border p-2">
                        @if($appointment->status === 'pending')
                            <form action="{{ route('appointments.approve', $appointment->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="approved"> <!-- Fix: Send status -->
                                <button  class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                            </form>
                            <form action="{{ route('appointments.rejected', $appointment->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>