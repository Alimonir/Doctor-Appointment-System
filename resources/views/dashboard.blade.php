<x-layout>
    <a class="btn" href="{{route('appointments.index')}}">appointments</a>
    @can('create_appointment')
        <div>create_appointment</div>
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
