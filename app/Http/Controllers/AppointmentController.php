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
        
    }

    
    public function create()
    {
        $doctors = User::role('doctor')->get();
        return view('appointments.create', compact('doctors'));
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
        // Ensure the selected slot is valid
        $doctor = User::findOrFail($request->doctor_id);
        $validSlot = $doctor->slots()->where('start_at','<=', $request->appointment_time)->where('end_at', '>=', $request->appointment_time)->exists();
        if (!$validSlot) {
            return redirect()->back()->with('error', 'Invalid slot selected.');
        }

        // Check if the patient already has an appointment at the same time
        $existingAppointment = Appointment::where('patient_id', Auth::id())->where('appointment_time', $request->appointment_time)->exists();
        if ($existingAppointment) {
            return redirect()->back()->with('error', 'You already have an appointment at this time.');
        }
        
        // Create a new appointment
       $appointment = Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,                                           
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',  
        ]);

        return redirect()->route('dashboard');
    }   

    public function updateStatus(Request $request, Appointment $appointment)
    {
        // dd($appointment->status);
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $appointment->status = $request->status;
        $appointment->save();
        return redirect()->route('dashboard');
    }
    public function destroy(Appointment $appointment){
           // Check if the logged-in user is the patient
           if(Auth::id() === $appointment->patient_id){
            $appointment->delete();
            return redirect()->route('dashboard');
           }
           // Check if the appointment was created within the last 2 hours
           if($appointment->created_at->diffInHours(now()) > 2){
            return redirect()->route('dashboard');
           }
           $appointment->delete();
           return redirect()->route('dashboard');
    }

    public function getDoctorSlots(User $doctor){
        $slots = $doctor->slots()->get();
        return response()->json($slots);
    }
}
