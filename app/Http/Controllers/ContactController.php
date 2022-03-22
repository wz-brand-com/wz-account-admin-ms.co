<?php

namespace App\Http\Controllers;
use App\Contacts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactusMail;
use Mail;
use Log;

class ContactController extends Controller
{
    public function contactform(){
        return view('contact-us');
    }

    public function store(Request $request){

        $request->validate([ 

            'name' => 'required', 
            'email' => 'required|email', 
            'phone' => 'required|digits:10|numeric', 
            'subject' => 'required', 
            'message' => 'required', 
        ]); 

        $data = $request->all(); 
        Contacts::create($data); 

        Mail::to('wizbrand@contact.com')->send(new ContactusMail($data));
        return back()->with('success', 'Your Request has been received. We will contact you Shortly.');

    } 

}

