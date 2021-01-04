<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;


class NewPost extends Notification implements ShouldQueue
{
    use Queueable;

    protected $following;
    protected $post;

    public function __construct(User $following, Post $post)
    {
        $this->following = $following;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'following_id' => $this->following->id,
            'following_name' => $this->following->name,
            'post_id' => $this->post->id,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'following_id' => $this->following->id,
                'following_name' => $this->following->name,
                'post_id' => $this->post->id,
            ],
        ];
    }
}
