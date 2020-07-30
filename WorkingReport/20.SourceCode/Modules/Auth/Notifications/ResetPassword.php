<?php

namespace Modules\Auth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $token;
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        dd($notifiable);
        $email=$notifiable->email;
        $title='Xin chào: '.$notifiable->fullname. '!';
        $url=route('home').'/password/reset/'.$this->token.'&email='.$email;
        $home_url=route('home');
        return (new MailMessage)
                    ->greeting($title)
                    ->subject('[SeHo]- Hỗ trợ quên mật khẩu')
                    ->line('Một yêu cầu thiết lập lại mật khẩu đã được gửi đến SEHO.')
                    ->line('Để hoàn tất quy trình vui lòng click vào liên kết dưới đây để đặt lại mật khẩu trong vòng 1h.Bỏ qua email này nếu bạn không phải là người yêu cầu.')
                    ->action('Đặt lại mật khẩu', $url)
                    ->line('Cám ơn đã sử dụng dịch vụ của chúng tôi !');
//                    ->markdown('auth.mail.index',['user'=>$notifiable,'url'=>$url,'title'=>$title,'home_url'=>$home_url]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

    }
}
