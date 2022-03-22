<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Organisation;
use App\Usersorganization;
use Log;
use App\User;
use App\SiteAdminTaskType;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($org_slug)
    {
       $taskTypeFromSiteAdmin = SiteAdminTaskType::all();
    
        $org = Organisation::where('org_slug',$org_slug)->first();
        // $user_id = $org['org_user_id'];
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $slug_id = $org['id'];  
        $org_users = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();
        $a_user_api_bearer_token = $this->getTaskAccessToken();
        // open condition open
        // ################# if condition apply for checking if organization has been blocked not allow to access dashboard 
        $block_or_blocked = $org_users['status'];
        $user_account_block = User::where('id',$user_id)->first();
        $block_user = $user_account_block['status'];
        
        if($block_or_blocked == 1){
            Log::info('organizatio block ho gaya hai');
            return view('admin/block-organization'); 
        }
        if($block_user == 1){
          Log::info('user account block ho gaya hai');
            return view('admin/status-blocked'); 
        }
        if($block_or_blocked == NULL){
            Log::info('epmty ho gaya status');
            return view('admin/remove-orgs');
        }
        else{
        // ##################### if condition apply for checking if organization has been blocked not allow to access dashboard 
        $getting_roll_id = $org_users->u_org_role_id;
        if($getting_roll_id ==1){
            return view('pages.task',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','taskTypeFromSiteAdmin')); 
        } // first if close
        if($getting_roll_id ==2){
            return view('manager/task',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','taskTypeFromSiteAdmin'));
        } // second if close
        return view('user/task',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','taskTypeFromSiteAdmin'));
        // open condition close
    }
     
    }

    private function getTaskAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
}
