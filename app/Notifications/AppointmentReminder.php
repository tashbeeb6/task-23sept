<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Jobs\SendAppointmentReminder;
use Illuminate\Support\Facades\Broadcast;

use function Laravel\Prompts\title;

class AppointmentReminder extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $appointment)
    {
      
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'Broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */ 
    public function toArray(object $notifiable): array
    {
        $locale =$notifiable->preferred_language ?? 'en';
        return [
            'title'=> __('reminder.title',[],$locale),
         
             'appointment_id' => $this->appointment->id,
               'message'=> __('reminder.message',[],$locale),
            'booking_date'   => $this->appointment->booking_date,
            'booking_time'   => $this->appointment->booking_time, 
            'service_id'     => $this->appointment->service_id,
            'provider_id'    => $this->appointment->provider_id,
            
        ];
    }
}
