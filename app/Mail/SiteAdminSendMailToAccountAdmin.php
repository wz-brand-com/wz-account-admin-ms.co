<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SiteAdminSendMailToAccountAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $SiteAdminSendMail;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($SiteAdminSendMail)
    {
        $this->SiteAdminSendMail = $SiteAdminSendMail;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@wizbrand.com')
        ->subject('Reset Password from wizbrand')
        ->view('Account_admin_dynamic')
        ->with('data', $this->SiteAdminSendMail);
       
    }
}
