<?php


namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPasswordNotification
{
    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(config('app.url') . route('password.reset', $this->token, false)))
            ->line('If you did not request a password reset, no further action is required.');
    }
}

// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Notification;

// class CustomResetPasswordNotification extends Notification
// {
//     use Queueable;

//     /**
//      * Create a new notification instance.
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Get the notification's delivery channels.
//      *
//      * @return array<int, string>
//      */
//     public function via(object $notifiable): array
//     {
//         return ['mail'];
//     }

//     /**
//      * Get the mail representation of the notification.
//      */
//     // public function toMail(object $notifiable): MailMessage
//     // {
//     //     return (new MailMessage)
//     //                 ->line('The introduction to the notification.')
//     //                 ->action('Notification Action', url('/'))
//     //                 ->line('Thank you for using our application!');
//     // }

//     // public function toMail($notifiable)
//     // {
//     //     return (new MailMessage)
//     //         ->line('You are receiving this email because we received a password reset request for your account.')
//     //         ->action('Reset Password', url(config('app.url') . route('password.reset', $this->token, false)))
//     //         ->line('If you did not request a password reset, no further action is required.');
//     // }





//     /**
//      * Get the array representation of the notification.
//      *
//      * @return array<string, mixed>
//      */
//     public function toArray(object $notifiable): array
//     {
//         return [
//             //
//         ];
//     }
// }
