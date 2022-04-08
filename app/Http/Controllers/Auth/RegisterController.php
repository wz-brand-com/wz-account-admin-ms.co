<?php

namespace App\Http\Controllers\Auth;

use Log;
use App\User;
use Socialite;
use App\Addprofile;
use App\Verifytoken;
use App\SocialProvider;
use Illuminate\Http\Request;
use Redirect, Response, DB, Config;
use App\Http\Controllers\Controller;
use App\Mail\WithOutOrganizatioUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Api\OrganisationApiController;

class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  protected $redirectTo = '/verify';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return IlluminateContractsValidationValidator
   */
 
  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return User
   */
  

  protected function activate($validToken, $email)
  {
    Log::info("2nd email or token aa gya hai");
    $membermail = $email;
    $validToken = Verifytoken::where('token', '=', $validToken)->first();
    Log::info("token aa gy hai");
    if ($validToken) {
      $membertoken = $validToken->token;
      return view('auth/member-register', compact('membermail', 'membertoken'));
    } else {
      return view('auth/invalid-member-request');
    }
  }
  

  public function verify()
  {
    return view('auth/verify');
  }

  
  // mail pe click krne ke bad jo page aaa rha hai usii page pe hu token validate krne pe page show ste-2
  
  public function userActivation($validToken, $email,$getting_name)
  {
    $getting_mail = $email;
    $getting_token = $validToken;
    $user_getting_name =  $getting_name;

    $validToken = Verifytoken::where('token', '=', $validToken)->first();
    if ($validToken) {
      $getting_token = $validToken->token;
      return view('activate', compact('getting_mail', 'getting_token','user_getting_name'));
    } else {
      return view('invalid-member-request');
    }
  }

  // activat time geting token and email ==== jab activation pe clik krenge tab isk atoken delete krwana hai
  public function userActivateStore(Request $request)
  {
    
    $getting_name = $request->name;
    $tokenIs = $request->tokenIsComming;
    $validate_token =  Verifytoken::where('token', '=', $tokenIs)->first();
    $get_email_by_token = $validate_token['email'];
    $check_user_email = User::where('email', $get_email_by_token)->first();
    $get_user_id = $check_user_email['id'];
    if($check_user_email){
      $check_user_email->name = $getting_name; 
      $check_user_email->email = $get_email_by_token;
      $check_user_email->password = Hash::make($request['password']);
      $check_user_email->save();
      Log::info("user activated successfully");
      $add_profile = new Addprofile();
      $add_profile->user_id = $get_user_id;

      $zname_clean = preg_replace('/\s*/', '', $getting_name);
      // convert the string to all lowercase
      $zname_taking = strtolower($zname_clean);
      Log::info("zname_taking is ".$zname_taking);
      $add_profile->user_name= $zname_taking;
      $add_profile->user_email = $get_email_by_token;
      $add_profile->country_id = $request->country_id;
      $add_profile->state_id = $request->state_id;
      $add_profile->city_id = $request->city_id;
      $add_profile->mobile = $request->mobile;
      $add_profile->save();
      Log::info("add profile save successfully");
      
      $findemail_token = Verifytoken::where('token', $tokenIs)->delete();
    }else{
      // $check_member_email = Usersorganization::where('u_org_user_email',$get_email_by_token)->first();
      // $get_email_id = $check_member_email['u_org_user_email'];
      $check_member_email = new User();
      $check_member_email->name = $getting_name; 
      $check_member_email->email = $get_email_by_token;
      $check_member_email->password = Hash::make($request['password']);
      $check_member_email->save();
      Log::info("user invited by admin with organization activated successfully");
     
      // taking id from user table then primary id of user will be save in Useroganization
      $find_user_id = User::where('email',$get_email_by_token)->first();
      $get_email_id = $find_user_id['id'];
      $get_user_name = $find_user_id['name'];
      $check_member_email = $find_user_id['email'];
      $memeberIdApiController = new OrganisationApiController();
      $email_with_org_sending = $memeberIdApiController->invitedByRegsiterUserIDNameStore($get_email_id,$check_member_email);
      Log::info('on register time value is going to verifying and update in Organisation'.print_r($email_with_org_sending,true));
      $add_profile = new Addprofile();
      $add_profile->user_id = $get_email_id;
      $add_profile->user_name= $getting_name;
      $add_profile->user_email = $get_email_by_token;
      $add_profile->country_id = $request->country_id;
      $add_profile->state_id = $request->state_id;
      $add_profile->city_id = $request->city_id;
      $add_profile->mobile = $request->mobile;
      $add_profile->save();
      Log::info("add profile save successfully");
      $findemail_token = Verifytoken::where('token', $tokenIs)->delete();
      return view('org');
    }
    // update condition
    return view('org');

    
  }


  protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    
    // add handleProviderCallback() function in RegisterController
    
    public function handleProviderCallback()
        {
            try
            {
                $socialUser = Socialite::driver('google')->user();
            }
            catch(\Exception $e)
            {
                return redirect('/');
            }
            //check if we have logged provider
            $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
            if(!$socialProvider)
            {
                //create a new user and provider
                $user = User::firstOrCreate(
                    ['email' => $socialUser->getEmail()],
                    ['name' => $socialUser->getName()]
                );
    
                $user->socialProviders()->create(
                    ['provider_id' => $socialUser->getId(), 'provider' => 'google']
                );
    
            }
            else
                $user = $socialProvider->user;
    
            auth()->login($user);
    
            return redirect('/org');
    
        }


  
}