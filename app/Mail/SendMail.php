<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    //protected $emails;
    public $timeout = 7200; // 2 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
       // $this->emails = $emails;
    }

    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       
        /* $input['subject'] = $this->details['subject'];
        $mailing = $this->details['message']; */
        $useremails = json_decode($this->details['emails']);
       

        foreach ($useremails as $users) {
            $email = new FormatMail($this->details);
             Mail::to($users)->queue($email);
           
            /* \Mail::send('emails.subscribers', compact('mailing'), function($message) use($input, $mailing, $users){
              
                $message->to($users)
                    ->subject($input['subject']);
            }); */
        }
    }
}