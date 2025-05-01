<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderRated extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your order has been delivered. Please rate the delivery and the order.',
            'order_id' => $this->order->id,
        ];
    }
    
    public function handle()
    {
        $user = $this->order->user;
        $user->notify(new OrderRated($this->order)); // Send notification
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your order has been delivered.')
            ->action('Rate Now', url('/rate-order/' . $this->order->id))
            ->line('Thank you for using our service!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
        ];
    }
}

