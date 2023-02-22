<?php

namespace Tests\Unit\Mail;

use App\Mail\ReportMail;
use App\Models\Quiz;
use App\Models\User;
use Mockery;
use Tests\TestCase;

class ReportMailTest extends TestCase
{
    protected $user;
    protected $report;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = Mockery::mock(User::class);
        $this->report = new ReportMail(
            $this->user,
            5,
        );
    }

    public function testBuild()
    {
        $response = $this->report->build();
        $this->assertInstanceOf(ReportMail::class, $response);
    }

    public function tearDown(): void
    {
        Mockery::close();
        unset($this->user);
        unset($this->report);
        parent::tearDown();
    }
}
