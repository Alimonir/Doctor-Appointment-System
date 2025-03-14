<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentsBooked extends Notification
{
    use Queueable;

    protected $appointment;
    protected $recipientType; // Store whether the recipient is a doctor or patient

    public function __construct($appointment, $recipientType)
    {
        $this->appointment = $appointment;
        $this->recipientType = $recipientType;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        // Custom message based on recipient type
        if ($this->recipientType === 'doctor') {
            return (new MailMessage)
                ->subject('New Appointment Booked')
                ->greeting('Hello Dr. ' . $notifiable->name)
                ->line('A new appointment has been booked with you.')
                ->line('Patient: ' . $this->appointment->patient->name)
                ->line('Date: ' . $this->appointment->appointment_time)
                ->action('View Appointments', url('/appointments'))
                ->line('Please confirm or reschedule the appointment.');
        } else {
            return (new MailMessage)
                ->subject('Appointment Confirmation')
                ->greeting('Hello ' . $notifiable->name)
                ->line('Your appointment has been booked successfully.')
                ->line('Doctor: ' . $this->appointment->doctor->name)
                ->line('Date: ' . $this->appointment->appointment_time)
                ->action('View Your Appointment', url('/appointments'))
                ->line('Thank you for using our service!');
        }
    }

    public function toArray($notifiable): array
    {
        // Custom database notification message
        if ($this->recipientType === 'doctor') {
            return [
                'message' => 'A new appointment has been booked with you.',
                'appointment_id' => $this->appointment->id,
                'patient' => $this->appointment->patient->name,
                'time' => $this->appointment->appointment_time,
            ];
        } else {
            return [
                'message' => 'Your appointment has been booked successfully.',
                'appointment_id' => $this->appointment->id,
                'doctor' => $this->appointment->doctor->name,
                'time' => $this->appointment->appointment_time,
            ];
        }
    }
}
