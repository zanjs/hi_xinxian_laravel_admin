<?php

namespace App\Jobs;
use App\User;
use App\Jobs\Job;
use App\Model\Card\MassMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SeedMessage extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $msgText;
    protected $phone;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct(User $user,$msgText,$phone)
    {
        $this->user = $user;
        $this->msgText = $msgText;
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $msgStart = msgSend($this->msgText,$this->phone);
        $massMess = new MassMessage;
        $massMess-> user_id = $this->user->id;
        $massMess-> phone = $this->phone;
        $massMess-> txt = $this->msgText;
        $massMess-> start = $msgStart;
        $massMess->save();
       /* file_put_contents("text.txt", $this->user->id."\n", FILE_APPEND);*/
    }
}
