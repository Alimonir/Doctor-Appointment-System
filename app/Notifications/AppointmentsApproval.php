<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;
use App\Models\Appointment;

class AppointmentsApproval extends Notification
{
    use Queueable;
    protected $appointment;
    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Appintment approval.')
            ->greeting('Hello ' . $notifiable->name)
            ->line('Your appointment has been approved.')
            ->line('Date: ' . $this->appointment->appointment_time)
            ->line('status: ' . $this->appointment->status)
            ->action('Notification Action', url('/appointments'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your appointment has been ' . $this->appointment->status . '!',
            'appointment_id' => $this->appointment->id,
            'doctor' => $this->appointment->doctor,
            'time' => $this->appointment->appointment_time,
        ];
    }
}
