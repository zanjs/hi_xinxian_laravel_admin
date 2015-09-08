<?php

namespace App\Jobs;
use App\User;
use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $count;
    protected $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$count,$email)
    {
        $this->user = $user;
        $this->count = $count;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $count = $this->count;
        $data['user'] = $this->user;
        $data['count'] = $this->count;

        $mailer->send('emails.reminder', $data, function ($m) {
            $m->to( $this->email,$this->user->name)->subject('发送成功');
        });

        file_put_contents('D:/test.txt', 'hello world!'.$count.date('YmdHis'));
    }
}
