<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Jobs\JobEmail;
use App\Mail\HelloMail;

class JobEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email;
    private $body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $body)
    {
        $this->email = $email;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array(
            'body' => $this->body
        );

        sleep(10);

        Mail::to($this->email)->send(new HelloMail($data));
    }
}
