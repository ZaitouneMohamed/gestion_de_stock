<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        // Mail::to('recipient@example.com')->send(new \App\Mail\ExampleEmail());
        $recipient = 'dwm23-zaitoune@ifiag.com';
        $subject = 'Demo Email';
        $content = 'Hello there! This is a demo email sent from Laravel.';

        Mail::raw($content, function ($message) use ($recipient, $subject) {
            $message->to($recipient);
            $message->subject($subject);
        });

        $this->info('Email sent successfully!');
        $this->info('Email sent successfully.');
    }
}
