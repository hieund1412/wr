<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $working_date;
    public $data;

    public function __construct($user_name, $working_date, $data)
    {
        $this->user_name = $user_name;
        $this->working_date = $working_date;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userName = $this->user_name;
        $workDate = $this->working_date;
        return $this->view('mail.report_mail')->subject('[working-report]' .$userName . ' ngày ' . $workDate);
    }
}
