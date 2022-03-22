<?php

namespace App\Mail;
use Illuminate\Foundation\Auth\RegisterController;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WithOutOrganizatioUser extends Mailable
{
    use Queueable, SerializesModels;
    public $without_orgnization_user;
    public $validToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($without_orgnization_user,$validToken)
    {
        $this->without_orgnization_user = $without_orgnization_user;
        $this->validToken = $validToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()  
    {
        return $this
        ->from('info@wizbrand.com')
        ->subject('Welcome to WizBrand.com | Verification Email for sign-up!')
        ->view('emails.activation')
        ->with('data',$this->without_orgnization_user,$this->validToken);
    }
}