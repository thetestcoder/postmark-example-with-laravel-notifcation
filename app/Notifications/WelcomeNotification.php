<?php

namespace App\Notifications;

use Coconuts\Mail\PostmarkTemplateMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class WelcomeNotification extends Notification
{
    use Queueable;

    const TEMPLATE_ID = "<template-id-here>";

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mailable = (new PostmarkTemplateMailable())
            ->identifier(self::TEMPLATE_ID)
            ->include([
                'name' => "The Test Coder"
            ]);

        Mail::to($notifiable->email)->send($mailable);

        return $mailable;
    }

}
