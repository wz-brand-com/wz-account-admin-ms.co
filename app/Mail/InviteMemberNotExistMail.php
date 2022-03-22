<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class InviteMemberNotExistMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invite_member_not_exist;
    public $validToken;
    public $organizationNameforMail;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite_member_not_exist,$validToken,$organizationNameforMail)
    {
        $this->invite_member_not_exist = $invite_member_not_exist;
        $this->validToken = $validToken;
        $this->organizationNameforMail = $organizationNameforMail;

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
         ->subject('Invitation by '.''.$this->organizationNameforMail. ''. ' Organization')
        ->view('Membermail.member_notexist_dynamic')
        ->with('data',$this->invite_member_not_exist, 'validToken',$this->validToken);
    }
}
