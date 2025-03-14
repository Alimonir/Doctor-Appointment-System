<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Slot;

class DashboardController extends Controller
{
   
public function index()
{
    $user = Auth::user();
    
    $appointments = Appointment::when($user->hasRole('doctor'), function ($query) use ($user) {
        return $query->where('doctor_id', $user->id);
    })->when($user->hasRole('patient'), function ($query) use ($user) {
        return $query->where('patient_id', $user->id);
    })->get();

    //slots
    $slots = Slot::where('user_id',Auth::id())->get();
    //doctors
    $doctors = User::role('doctor')->get();

    return view('dashboard', compact('appointments', 'slots', 'doctors'));}
}
