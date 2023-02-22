<?php

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\SendReportMail;
use App\Models\User;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Mockery;
use Tests\TestCase;

class SendReportMailTest extends TestCase
{
    protected $command;
    protected $userRepo;
    protected $quizRepo;
    protected $users;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepo = Mockery::mock(UserRepositoryInterface::class);
        $this->quizRepo = Mockery::mock(QuizRepositoryInterface::class);
        $this->command = new SendReportMail($this->userRepo, $this->quizRepo);
        $this->users = User::factory()->count(10)->make();
    }

    public function testHandle()
    {
        Mail::fake();

        $this->userRepo->shouldReceive('getAdmins')->andReturn($this->users);
        $this->quizRepo->shouldReceiVe('getTodayQuiz')->andReturn();

        $response = $this->command->handle();
        $this->assertTrue($response);
    }

    public function tearDown(): void
    {
        unset($this->command);
        unset($this->userRepo);
        unset($this->quizRepo);
        unset($this->users);
        parent::tearDown();
    }
}
