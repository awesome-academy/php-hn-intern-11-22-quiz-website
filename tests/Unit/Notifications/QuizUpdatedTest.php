<?php

namespace Tests\Unit\Notifications;

use App\Models\Quiz;
use App\Models\User;
use App\Notifications\QuizUpdated;
use Mockery;
use Tests\TestCase;

class QuizUpdatedTest extends TestCase
{
    protected $notification;
    protected $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'id' => 1,
            'status' => 'updated',
        ];
        $this->notification = new QuizUpdated($this->data);
    }

    public function testVia()
    {
        $notifiable = Mockery::mock(User::class);
        $this->assertEquals(['database'], $this->notification->via($notifiable));
    }

    public function testToArray()
    {
        $notifiable = Mockery::mock(Quiz::class);
        $result = $this->notification->toArray($notifiable);

        $this->assertIsArray($result);
    }

    public function tearDown(): void
    {
        unset($this->data);
        unset($this->notification);
        parent::tearDown();
    }
}
