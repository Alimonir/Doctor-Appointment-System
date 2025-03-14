<x-simpleheader>
    <form action="{{ route('appointments.store') }}" method="post">
        @csrf
        @session('error')
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>                                               
        @endsession
        <!-- Doctor Selection -->
        <div class="mb-4">
            <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
            <select name="doctor_id" id="doctor_id" required onchange="fetchSlots(this.value)"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Select a Doctor</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->doctor->specialization }})</option>
                @endforeach
            </select>
            @error('doctor_id')
                <div class="text-red-500 mt-2 text-sm">{{ 'Select your Doctor' }}</div>
            @enderror
        </div>

        <!-- Slot Selection -->
        <div class="mb-4">
            <label for="appointment_time" class="block text-sm font-medium text-gray-700">Available Slots</label>
            <select name="appointment_time" id="appointment_time" required
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">First, choose a doctor</option>
            </select>
            @error('appointment_time')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Book Appointment</button>
        </div>

    </form>

    <!-- JavaScript to Fetch Slots -->
    <script>
       function fetchSlots(doctorId) {
    let slotSelect = document.getElementById('appointment_time');
    slotSelect.innerHTML = '<option value="">Loading slots...</option>';

    fetch(`/doctor/${doctorId}/slots`)
        .then(response => response.json())
        .then(slots => {
            slotSelect.innerHTML = '<option value="">Select a slot</option>';

            if (slots.length === 0) {
                slotSelect.innerHTML = '<option value="">No available slots</option>';
                return;
            }

            slots.forEach(slot => {
                let formattedStart = slot.start_at.substring(0, 5); // Extract HH:MM
                let formattedEnd = slot.end_at.substring(0, 5);     // Extract HH:MM

                let option = document.createElement('option');
                option.value = slot.start_at;
                option.textContent = `${formattedStart} to ${formattedEnd}`;
                slotSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error("Error fetching slots:", error);
            slotSelect.innerHTML = '<option value="">Error loading slots</option>';
        });
}

    </script>
</x-simpleheader>
