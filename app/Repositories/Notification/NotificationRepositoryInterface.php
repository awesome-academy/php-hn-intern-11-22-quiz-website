<?php
namespace App\Repositories\Notification;

use App\Repositories\RepositoryInterface;
use App\Models\User;

interface NotificationRepositoryInterface extends RepositoryInterface
{
    public function notify(User $user, $status);
}
