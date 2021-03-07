<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CancelOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $cancel_order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cancel_order)
    {
        $this->cancel_order = $cancel_order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello, Admin')
            ->subject('Cancel Order ...')
            ->line('Now Cancel Order Id ' . $this->cancel_order->order_id)
            ->action('view', url('/admin/cancels/orders/' . $this->cancel_order->id))
            ->line('Thank you for using our application!');
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
            //
        ];
    }
}
