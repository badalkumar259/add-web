<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketStatusChanged extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $title; 
    protected $status; 
    public function __construct($title, $status)
    {
        $this->title=$title;
        $this->status=$status;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
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

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        if($this->status){
            return [
                'data' =>'Your ticket title '.$this->title.' was status changed to '. $this->status
            ];
        }else{
            return [
                'data' =>'New ticket title '.$this->title.' assigned with status Pending'
            ];
        }
    }
}
