<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LimitAccount extends Notification
{
    use Queueable;

    /**
        $data = [
            'img' => null,
            'name' => 'TheGround',
            'url' => null,
            'task' => 'votre compte sera archivez dans ' . $d . ' jours',
            'msg' => 'penser a recharger votre Range',
            'limit' => $limit,
            'days'  => $days
        ];
     */
    /**
     * @var
     */
    private $data;
    /**
     * @var
     */
    private $notification_id;

    /**
     * Create a new notification instance.
     *
     * @param array $data
     */
    public function __construct($data)
    {
        //
        $this->days = $data;
        $this->notifiable();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'img'               => $this->data['img'],
            'name'              => $this->data['name'],
            'task'              => $this->data['task'],
            'msg'               => $this->data['msg'],
            'notification_id'   => $this->notification_id
        ];
    }

    public function notifiable()
    {
        if(isset($this->data['limit'])){
            $this->notification_id = $this->data['limit'] . '-' . $this->data['days'];
        }
        else{
            $this->notification_id = null;
        }
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
