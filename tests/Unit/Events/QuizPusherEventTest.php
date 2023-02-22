<?php

namespace Tests\Unit\Events;

use App\Events\QuizPusherEvent;
use Tests\TestCase;

class QuizPusherEventTest extends TestCase
{
    protected $data;
    protected $user;

    public function testBroadcastChannel()
    {
        $this->data = [
            'id' => 1,
            'status' => 'updated',
        ];

        $event = new QuizPusherEvent($this->data, $this->user);
        $channel = $event->broadcastOn();
        $eventName = $event->broadcastAs();

        $this->assertEquals('my-channel-', $channel->name);
        $this->assertEquals('my-event', $eventName);
    }
}
