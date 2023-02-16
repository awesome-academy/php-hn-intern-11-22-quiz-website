<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $num;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $num)
    {
        $this->user = $user;
        $this->num = $num;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.report')->with(['user' => $this->user, 'num' => $this->num]);
    }
}
