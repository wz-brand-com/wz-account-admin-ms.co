<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Organisation;
use App\Usersorganization;
use Log;


class UserManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($org_slug)
    {
        $org = Organisation::where('org_slug',$org_slug)->first();
        // $user_id = $org['org_user_id'];
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $slug_id = $org['id'];
        $org_users = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();


        $a_user_api_bearer_token = $this->getUserManagerAccessToken();
         // open condition open
         $getting_roll_id = $org_users->u_org_role_id;
         Log::info('role id le kr aaa rha hai tas page');
         if($getting_roll_id ==1){
             return view('pages.user-manager',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id')); 
         } // first if close
         if($getting_roll_id ==2){
             return view('manager/user-manager',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id'));
         } // second if close
         return view('user/user-manager',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id'));
         // open condition close
    }

    // for generate token
    private function getUserManagerAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
}
