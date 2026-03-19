<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use App\Models\Message;
use App\Notifications\MessageNotification;

class MessageJob implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected $message;
    /**
     * Create a new job instance.
     */
      public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
          $this->user->notify(new MessageNotification($this->message));
    }
}
