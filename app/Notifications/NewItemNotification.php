<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

use Illuminate\Notifications\Messages\MailMessage;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class NewItemNotification extends Notification
{
    use Queueable;
    public $notification_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification_data)
    {
        $this->notification_data = $notification_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'database',
            'firebase'
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }


    public function toDatabase($notifiable)
    {
        
        // return dd($this->notification_data);
        return
        [
            $this->notification_data,
        ];
    }
    public function toFirebase($notifiable)
    {

            return (new FirebaseMessage)
            ->withTitle($this->notification_data['title'])
            ->withBody($this->notification_data['subject'])
            ->withImage($this->notification_data['image'])
            ->withPriority($this->notification_data['priority'])
            ->withAdditionalData([
                'model_name' => $this->notification_data['model_name'],
                'model_id' => $this->notification_data['model_id']
            ])
            ->asNotification($this->notification_data['fcm_token']);
        
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
