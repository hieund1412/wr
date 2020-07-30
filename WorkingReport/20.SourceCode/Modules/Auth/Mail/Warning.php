<?php

namespace Modules\Auth\Http\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Warning extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $token;
    public function __construct($user)
    {
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        view()->addNamespace('login_view', app_path('Auth/Views'));
        return $this->view('login_view::mail')
            ->subject('CMS-AM Hỗ Trợ Quên Mật Khẩu');
    }
}
