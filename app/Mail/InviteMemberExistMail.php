<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class InviteMemberExistMail extends Mailable
{
    use Queueable, SerializesModels;
    public $invite_member_exist;
    public $ExistOrganizationName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite_member_exist,$ExistOrganizationName)
    {
        $this->invite_member_exist = $invite_member_exist;
        $this->ExistOrganizationName = $ExistOrganizationName;
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
        ->subject('Invitation by '.''.$this->ExistOrganizationName. ''. ' Organization')
        ->view('Membermail.member_exist_dynamic')
        ->with('data',$this->invite_member_exist);
    }
}
