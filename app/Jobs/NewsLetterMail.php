<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\NewsLetterMail as NewsLetterEmail;
use Illuminate\Support\Facades\Mail;

class NewsLetterMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $newsletter_emails;
    protected $newLesson;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newsletter_emails, $newLesson)
    {
        $this->newsletter_emails = $newsletter_emails;
        $this->newLesson = $newLesson;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->newsletter_emails as $email) {
            Mail::to($email->email)->send(new NewsLetterEmail($this->newLesson));
        }
    }
}
