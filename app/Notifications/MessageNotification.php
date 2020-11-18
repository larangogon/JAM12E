<?php

namespace App\Notifications;

use App\Entities\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
{
    use Queueable;

    /**
     * @var Message
     */
    private $message;

    /**
     * ProductNotification constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * @param $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id'           => $this->message->id,
            'body'         => $this->message->body,
            'recipient_id' => $this->message->recipientId->name,
            'sender_id'    => $this->message->senderId->name,
        ];
    }
}
