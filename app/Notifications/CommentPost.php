<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentPost extends Notification
{
    use Queueable;
    public $user;
    public $post;
    public $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $post, $comment)
    {
        $this->user = $user;
        $this->post = $post;
        $this->comment = $comment;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id'=>$this->user->id,
            'user_name'=>$this->user->name,
            'post_id'=>$this->post->id,
            'post_title'=>$this->post->title,
            'comment'=>$this->comment->body,
        ];
    }
}
