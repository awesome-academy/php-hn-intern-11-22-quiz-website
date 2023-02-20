<?php
namespace App\Repositories\Notification;

use App\Repositories\BaseRepository;
use App\Models\Notifications;
use App\Models\User;
use App\Notifications\QuizUpdated;
use Pusher\Pusher;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    public function getModel()
    {
        return Notifications::class;
    }

    public function notify(User $user, $status)
    {
        $data = [
            'id' => $user->id,
            'status' => $status,
        ];
        $user->notify(new QuizUpdated($data));
        $notification_id = $user->notifications->first()->id;
        $data['notification_id'] = $notification_id;
        $options = [
            'cluster' => 'ap1',
            'encrypted' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('my-channel-' . $user->id, 'my-event', $data);

        return true;
    }
}
