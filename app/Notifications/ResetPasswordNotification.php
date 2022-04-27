<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        return (new MailMessage)
                    ->line('Forgot your Password ?')
                    ->line("<p style='text-align: center; width: 100%;'>pin code  </p>")                   
                    ->line("<p style='border-style: solid; border-radius: 10px;font-size: 24px;text-align: center;color:green'> ".$this->data['pin_code']."</p>" )                   
                    
                    ->line('reset from url ')
                    ->action('Click to reset',$this->data['url'])
                    ->line('If you did not request a password reset, no further action is required.')
                    ->line('Thank you for using atfaluna application!');
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
