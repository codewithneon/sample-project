<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $body;
    private $title;

    /**
     * Create a new notification instance.
     *
     * @param $title
     * @param $body
     */
    public function __construct($title, $body)
    {
        $this->body=$body;
        $this->title=$title;
    }

    /**
     * @param $title
     * @param $body
     * @return UserNotification
     */
    public static function for($title, $body): UserNotification
    {
        return new static($title, $body);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)->greeting($this->title)->line($this->body);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
