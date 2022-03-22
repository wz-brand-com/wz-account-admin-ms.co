<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Usersorganization;
use App\Organisation;
use Auth;

class WizardProjectController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($org_slug)
    {
        $org = Organisation::where('org_slug',$org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $slug_id = $org['id'];
        $org_users = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();

         // ################# if condition apply for checking if organization has been blocked not allow to access dashboard 
         $block_or_blocked = $org_users['status'];
         $user_account_block = User::where('id',$user_id)->first();
         $block_user = $user_account_block['status'];
         $a_user_api_bearer_token = $this->wizardProjectAccessToken();
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
 
         // open condition open
         $getting_roll_id = $org_users->u_org_role_id;
         Log::info('role id le kr aaa rha hai tas page');
         if($getting_roll_id ==1){
             return view('user/wizard',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id')); 
         } // first if close
         if($getting_roll_id ==2){
             return view('user/wizard',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id'));
         } // second if close
         return view('user/wizard',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id'));
         // open condition close
         }
    }


    public function targetwizardproject($org_slug,$project_name,$id)

    {
        $project_id_from_project = $id;
        Log::info("we are getting project id" .$project_id_from_project);
        $org = Organisation::where('org_slug',$org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        Log::info('we are getting org_id name' .$org_id);
        $slug_id = $org['id'];
        $org_users = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();

         // ################# if condition apply for checking if organization has been blocked not allow to access dashboard 
         $block_or_blocked = $org_users['status'];
         $user_account_block = User::where('id',$user_id)->first();
         $block_user = $user_account_block['status'];
         $a_user_api_bearer_token = $this->wizardProjectAccessToken();
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
 
         // open condition open
         $getting_roll_id = $org_users->u_org_role_id;
         Log::info('role id le kr aaa rha hai tas page');
         if($getting_roll_id ==1){
             return view('wizard-projects/projectcontinue',compact('org_slug','org_id','project_name','project_id_from_project','getting_roll_id','a_user_api_bearer_token','slug_id')); 
         } // first if close
         if($getting_roll_id ==2){
             return view('wizard-projects/projectcontinue',compact('org_slug','org_id','project_name','project_id_from_project','getting_roll_id','a_user_api_bearer_token','slug_id'));
         } // second if close
         return view('wizard-projects/projectcontinue',compact('org_slug', 'org_id','project_name','project_id_from_project','getting_roll_id','a_user_api_bearer_token','slug_id'));
         // open condition close
         }
    }

        public function createStepOne(Request $request,$org_slug)
        {
           
            $product = $request->session()->get('product');
            $org = Organisation::where('org_slug',$org_slug)->first();
            $user_id = Auth::user()->id;
            $org_id = $org['id'];
            $getting_roll_id = '1';
            Log::info('org_id main  kiya aa rha hai value  ' .$org);
            $org_user = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();
            $a_user_api_bearer_token = $this->wizardProjectAccessToken();
            return view('wizard-projects.create-step-one',compact('product','org_user','org_slug','getting_roll_id','org_id','a_user_api_bearer_token'));
        }

       

        // for generate token
    private function wizardProjectAccessToken(){  
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
       
}
