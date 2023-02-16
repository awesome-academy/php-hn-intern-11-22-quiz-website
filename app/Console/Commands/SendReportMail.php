<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Quiz\QuizRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportMail;

class SendReportMail extends Command
{
    protected $userRepo;
    protected $quizRepo;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyReport:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily report to admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepo,
        QuizRepositoryInterface $quizRepo
    ) {
        parent::__construct();
        $this->userRepo = $userRepo;
        $this->quizRepo = $quizRepo;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = $this->userRepo->getAdmins();
        $num = $this->quizRepo->getTodayQuiz();

        foreach ($users as $user) {
            $mailable = new ReportMail($user, $num);
            Mail::to($user)->queue($mailable);
        }

        return true;
    }
}
