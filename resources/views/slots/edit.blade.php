<x-layout>
    <h1 class="text-2xl font-bold mb-6">Edit Slot</h1>
    <form action="{{route('slots.update',$slot->id)}}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="start_at" class="block text-sm font-medium text-gray-700">start_at</label>
            <input type="time" name="start_at" id="start_at"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm"
                ">
            @error('start_at')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
            <div>
            <label for="end_at" class="block text-sm font-medium text-gray-700">end_at</label>
            <input type="time" name="end_at" id="end_at"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 text-gray-900 px-3 py-2 text-sm"                  value="{{$slot->end_at}}">
            @error('end_at')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sumbit</button>

    </form>
</x-layout> 