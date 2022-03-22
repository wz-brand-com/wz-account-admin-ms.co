<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class PasswordChangeSendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $passwordChangeSendMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($passwordChangeSendMail)
    {
        $this->passwordChangeSendMail  = $passwordChangeSendMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@wizbrand.com')
        ->subject('Password has been change successfully')
        ->view('Account_admin_password_change_dynamic')
        ->with('data', $this->passwordChangeSendMail);
       
    }
}
