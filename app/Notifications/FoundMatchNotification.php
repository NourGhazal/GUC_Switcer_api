<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FoundMatchNotification extends Notification
{
    use Queueable;      
    protected $match;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($match)
    {
        $this->match=$match;
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
    {   $match = $this-> match;
        $name = $match->name;
        $personal_mail = $match->personal_mail;
        $phone_num = $match->phone_num;
        return (new MailMessage)
                    ->line('We found you a switch :)')
                    ->line("his/her name: {$name}")
                    ->line("email: {$personal_mail}")
                    ->line("phone number: {$phone_num}")
                    ->line('please note that your switchs were removed to avoid duplicated matches')
                    ->line('if you did not proceed with this switch please request a new switch')
                    ->action('Home',$url="/home");
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
