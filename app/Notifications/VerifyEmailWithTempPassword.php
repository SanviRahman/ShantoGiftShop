<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;

class VerifyEmailWithTempPassword extends VerifyEmail
{
    public function toMail($notifiable): MailMessage
    {
        $url = $this->verificationUrl($notifiable);

        $message = (new MailMessage())
            ->subject('Verify Email Address')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email Address', $url);

        $tempPassword = null;

        if (! empty($notifiable->temp_password)) {
            try {
                $tempPassword = Crypt::decryptString($notifiable->temp_password);
            } catch (\Throwable $e) {
                $tempPassword = null;
            }
        }

        if ($tempPassword) {
            $message->line('Temporary password: '.$tempPassword)
                ->line('Use this password to login with your email if needed. Please change it after verification.');
        }

        return $message->line('If you did not create an account, no further action is required.');
    }
}

