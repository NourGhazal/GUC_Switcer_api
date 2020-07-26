<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoubleSwitchNotification extends Notification
{
    use Queueable;      
    protected $match1;
    protected $match2;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($match1,$match2)
    {
        $this->match1=$match1;
        $this->match2=$match2;
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
    {   $match1 = $this-> match1;
        $name = $match1->name;
        $personal_mail = $match1->personal_mail;
        $phone_num = $match1->phone_num;
        $match2= $this->match2;
        $user2 = $match2->name;
        $personal_mail2=$match2->personal_mail;
        $phone_num2=$match2->phone_num;
        return (new MailMessage)
                    ->line('We found you a double switch :)')
                    ->line('please contact')
                    ->line("name: {$name}")
                    ->line("email: {$personal_mail}")
                    ->line("phone number: {$phone_num}")
                    ->line('And contact')
                    ->line("name: {$user2}")
                    ->line("email: {$personal_mail2}")
                    ->line("phone number: {$phone_num2}")
                    ->line('please note that you need to contact both to preform a double switch')
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
