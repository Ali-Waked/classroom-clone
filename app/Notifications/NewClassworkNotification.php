<?php

namespace App\Notifications;

use App\Models\Classwork;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class NewClassworkNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Classwork $classwork)
    {
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $via = ['database'];
        // $notificationTypes = $notifiable->profile?->notification_type;
        $profile = $notifiable->profile;
        // if ($notificationTypes) {
        if ($profile->recive_email_notification) {
            $via[] = 'mail';
        }
        if ($profile->recive_broadcast_notification) {//recive_push_notification
            $via[] = 'broadcast';
        }
        if ($profile->recive_sms_notification) {
            $via[] = 'vonage';
        }
        // }
        // dd($via);

        return $via;
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $classwork = $this->classwork;
        return (new MailMessage)
            ->subject(__('New :type', ['type' => $classwork->type->value]))
            ->greeting(__('Hi :name', ['name' => $notifiable->name]))
            ->line($this->getContent())
            ->action('Notification Action', route('classwork.show', [$classwork->classroom_id, $classwork->id]))
            ->line(__('Thank you for using our application'));
    }
    public function toVonage(object $notifiable): VonageMessage
    {
        return (new VonageMessage)->content(__('A new classwork created!'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $classwork = $this->classwork;
        return [
            'title' => __('New :type', ['type' => $classwork->type->value]),
            'body' =>  $this->getContent(),
            'image' => '',
            'link' => route('classwork.show', [$classwork->classroom_id, $classwork->id]),
            'classwork_id' => $classwork->id,
        ];
    }
    public function getContent(): string
    {
        $classwork = $this->classwork;
        return  __(':name posted a new :type :title', [
            'name' => $classwork->user->name,
            'type' => __($classwork->type->value),
            'title' => $classwork->title,
        ]);
    }
}
