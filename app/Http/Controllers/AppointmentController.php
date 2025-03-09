<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    
    public function index(Request $request)
    {
          $appointments= Appointment::when($request->user()->hasRole('doctor'),function ($query) use ($request){
            return $query->where('doctor_id',$request->user()->id);
        })->when($request->user()->hasRole('patient'),function ($query) use ($request){
            return $query->where('patient_id',$request->user()->id);
        })->get();
        return view('appointments.index', ['appointments' => $appointments]);
    }

    /**
     * عرض البانات
     */
    public function create()
    {
        $doctors = User::role('doctor')->get();
        return view('appointments.create', ['doctors' => $doctors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request...
        $request->validate([
            'doctor_id' => 'required',
            'appointment_time' => 'required',
        ]);  

        // Create a new appointment
       Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,                                           
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index');
    }   

    public function updateStatus(Request $request, Appointment $appointment)
    {
        // dd($appointment->status);
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $appointment->status = $request->status;
        $appointment->save();
        return redirect()->route('appointments.index');
    }
    
}
