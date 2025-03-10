<x-layout>
            <h1 class="text-2xl font-bold mb-6">Available Slots</h1>
            <a href="{{route('slots.create')}}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">Add Slot <i class="fa fa-plus"></i></a>
            <div class="mt-6">
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
                        <tr class="bg-white border-b">
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
        </x-layout>