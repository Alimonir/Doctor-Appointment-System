<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Slot extends Model
{
    protected $fillable = [
        'start_at',
        'end_at',
        'user_id',   
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function appointment(){
        return $this->hasOne(Appointment::class);
    }

    /**
     * Accessor: Format start_at date
     */
    public function getStartAtFormattedAttribute(): string
    {
        return Carbon::parse($this->start_at)->format('Y-m-d H:i');
    }

    /**
     * Accessor: Format end_at date
     */
    public function getEndAtFormattedAttribute(): string
    {
        return Carbon::parse($this->end_at)->format('Y-m-d H:i');
    }
}
