<?php

namespace App\Notifications;

// use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChatNotification extends Notification 
{
    // use Queueable;
    
    private $conversationData;
    public $connection = 'redis';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($conversationData)
    {
        $this->conversationData = $conversationData;
        // $this->afterCommit();

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
            // 'mail',
            'database',
            // 'broadcast'
        ];
    }
    // public function viaQueues()
    // {
    //     return [
    //         'database' => 'mail-queue',
    //         // 'broadcast' => 'slack-queue',
    //     ];
    // }
    
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {

    //     return (new MailMessage)                    
    //         ->name($this->conversationData['name'])
    //         ->line($this->conversationData['body'])
    //         ->action($this->conversationData['conversationMsg'], $this->conversationData['conversationUrl'])
    //         ->line($this->conversationData['thanks']);            
    // }
    public function toDatabase($notifiable)
    {
        
        return
        [
            $this->conversationData,
        ];
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
            'conversation_id' => $this->conversationData['conversation_id']
        ];
    }
}
