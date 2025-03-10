<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_time',   
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
