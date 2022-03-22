<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\WithOutOrganizatioUser;
use Illuminate\Support\Facades\Mail;
use App\Usersorganization;
use App\Organisation;
use App\Verifytoken;
use App\User;
use Log;


class AuthController extends Controller
{
    public function registrationForm(){
        Log::info('we are in regisrter form');
    return view('custom_auth.register');
}

public function registerUser(Request $request)
{
    $validate = \Validator::make($request->all(), [
        'name' 		=> 'required',
        'email'	 	=> 'required|email|unique:users|max:255',
        'g-recaptcha-response' => 'required|captcha',
       
    ]);

   
    if( $validate->fails()){
        return redirect()->back()->withErrors($validate);
    }
    $gettingemail  =  $request->email;
    Log::info('register time email aaa agay | ');
    $validate_email = Usersorganization::where('u_org_user_email',$gettingemail)->first();
    Log::info('validate_email what value is came| ');
    if(empty($validate_email)){
         // ############# when user register by self password will be auto save and token also in token table open
    $autogen = rand();
    $validToken = sha1(time()) . rand();
    $verifycoursetoken = new Verifytoken();
    $verifycoursetoken->token =  $validToken;
    $verifycoursetoken->email = $request['email'];
    $verifycoursetoken->save();
    Log::info("token save ho rha hai");
    // by self register account with Any oraganization open
    $without_orgnization_user = array(
      'name' => $request['name'],
      'email' => $request['email'],
      'token' =>  $validToken,
    );
    Mail::to($without_orgnization_user['email'])->send(new WithOutOrganizatioUser($without_orgnization_user, $validToken));
    // by self register account with without oraganization close
    Log::info("email chala gaya");
    // ############# when user register by self password will be auto save and token also in token table close
        $user_create = User::create([
            // 'password'   => bcrypt($request->password),
            'password' => Hash::make($autogen),
            'email'      => $request->email,
            'name'       => $request->name
        ]);
       
        // return view('auth/verify');
        return redirect('/auth/verify')->with('success', 'Successfully registered');
    }
    else{
        Log::info('already assign organization so please check your  mail');
        return view('/custom_auth.accessdenied')->with('danger', 'Access Denied Please Check Your Mail');
    }
}
public function accesserror(){
    return view('accessdenied');
}


}
