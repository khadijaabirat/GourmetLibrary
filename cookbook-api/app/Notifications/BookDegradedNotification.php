<?php

namespace App\Notifications;

use App\Models\Copy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookDegradedNotification extends Notification
{
    use Queueable;
    protected $copy;
    /**
     * Create a new notification instance.
     */
    public function __construct(Copy $copy)
    {
        $this->copy = $copy;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Alerte : Livre Dégradé')
                    ->greeting('Bonjour Chef Bibliothécaire,')
                    ->line('Une copie du livre "' . $this->copy->book->title . '" a été marquée comme dégradée.')
                    ->line('Code de référence : ' . $this->copy->reference_code)
                    ->line('Détails des dégâts : ' . $this->copy->damage_details)
                    ->action('Voir les statistiques', url('/api/stats/global'))
                    ->line('Merci de planifier sa réparation ou son remplacement.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
