<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendRegisterEmailNotifcation extends Notification
{
    use Queueable;
  
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        // self::$__token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $token=$notifiable->token;
        $name = $notifiable->name;
        return (new MailMessage)
                    ->line("hi {$name}")
                    ->line('Please click the button below to verify your email address.')
                    ->action('verify Email address', url("/api/verify/{$token}"));
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
