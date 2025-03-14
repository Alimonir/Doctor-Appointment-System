<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Notifications\AppointmentsApproval;
use App\Notifications\AppointmentsBooked;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     */
    public function created(Appointment $appointment): void
    {
        if ($appointment->patient) {
            $appointment->patient->notify(new AppointmentsBooked($appointment, 'patient'));
        }
    
        if ($appointment->doctor) {
            $appointment->doctor->notify(new AppointmentsBooked($appointment, 'doctor'));
        }
    }

    /**
     * Handle the Appointment "updated" event.
     */
    public function updated(Appointment $appointment): void
    {
        if ($appointment->wasChanged('status')) {
            $appointment->patient->notify(new AppointmentsApproval($appointment));
        }
    }

    /**
     * Handle the Appointment "deleted" event.
     */
    public function deleted(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "restored" event.
     */
    public function restored(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "force deleted" event.
     */
    public function forceDeleted(Appointment $appointment): void
    {
        //
    }
}
