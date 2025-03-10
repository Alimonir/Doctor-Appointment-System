<x-layout>
    @can('create_appointment')
    <a class="btn bg-green-500 text-white px-2 py-1 rounded" href="{{route('appointments.index')}}">My Appointments</a>
     @endcan

    @can('view_appointment')
    <a class="btn bg-green-500 text-white px-2 py-1 rounded" href="{{route('appointments.index')}}">See Your Appointments</a>
     @endcan
    @can('view_appointment')
        <div>view_appointment</div>
    @endcan
    @can('edit_appointment')
    @endcan
    @can('delete_appointment')
        <div>delete_appointment</div>
    @endcan
    @can('delete_user')
        <div>delete_user</div>
    @endcan
    @can('settings')
        <div>settings</div>
    @endcan
    
</x-layout>
