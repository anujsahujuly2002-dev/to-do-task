<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Channels\FirebaseChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ToDoListNotification extends Notification
{
    use Queueable;
    private $username;
    /**
     * Create a new notification instance.
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FirebaseChannel::class,'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toFirebase($notifiable)
    {
        $message ="To Do List assigned";
        return [
            'title' => 'To Do',
            'body' =>  $message ,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
    
         $message = "To Do List assigned";

        return [
            'name'=>$this->username,
            'subject'=> 'To Do',
            'content'=> $message
        ];
    }
}
