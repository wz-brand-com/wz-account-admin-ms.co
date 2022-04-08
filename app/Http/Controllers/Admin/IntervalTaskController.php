<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Organisation;
use App\Usersorganization;
use Log; 
use App\User;
use App\Http\Controllers\Api\OrganisationApiController;

class IntervalTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    // public function index($org_slug)
    // {
    //     $org = Organisation::where('org_slug',$org_slug)->first();
    //     $user_id = Auth::user()->id;
    //     $org_id = $org['id']; 
    //     $slug_id = $org['id'];
    //     $org_users = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();
    //     $getting_all_users = User::all();
    //     // send interval task open who have already invited user open
    //     $userorg_list = Organisation::where('org_slug',$org_slug)->first();
    //     $slug_name_find = $userorg_list['id'];
    //     $org_id = $userorg_list['id']; 
        
    //     $find_org_user_email = Usersorganization::select('u_org_user_email')->where('u_org_organization_id',$slug_name_find)->where('u_org_organization_id',$org_id)->where('u_org_user_email','!=' , NULL)->GroupBy('u_org_user_email')
    //     ->get(); 
    //     Log::info('interval task');
    //     // send interval task open who have already invited user close

    //     // interval task for manager open
    //     $manager_rol = '2';
    //     $web_user_rol = '3'; 
    //     $int_t_user_manager_assign = Usersorganization::select('u_org_user_email')->where('u_org_organization_id',$org_id)->where('u_org_user_email','!=' ,NULL)->where('u_org_role_id',$manager_rol)->orwhere('u_org_role_id',$web_user_rol)->GroupBy('u_org_user_email')
    //     ->get();
    //     // interval task for manager close
    //     $a_user_api_bearer_token = $this->getIntTaskAccessToken();
    //     // ################# if condition apply for checking if organization has been blocked not allow to access dashboard 
    //     $block_or_blocked = $org_users['status'];
    //     $user_account_block = User::where('id',$user_id)->first();
    //     $block_user = $user_account_block['status'];
        
    //     if($block_or_blocked == 1){
    //         Log::info('organizatio block ho gaya hai');
    //         return view('admin/block-organization'); 
    //     }
    //     if($block_user == 1){
    //         Log::info('user account block ho gaya hai');
    //         return view('admin/status-blocked'); 
    //     }
    //     if($block_or_blocked == NULL){
    //         Log::info('epmty ho gaya status');
    //         return view('admin/remove-orgs');
    //     }
    //     else{
    //     // ##################### if condition apply for checking if organization has been blocked not allow to access dashboard 

       
    //     // open condition open
    //      $getting_roll_id = $org_users->u_org_role_id;
    //      if($getting_roll_id ==1){
        
          
    //         return view('pages.interval_task',compact('org_slug', 'getting_all_users','getting_roll_id','a_user_api_bearer_token','slug_id','find_org_user_email')); 

          
    //      } // first if close
    //      if($getting_roll_id ==2){
    //          return view('manager/interval_task',compact('org_slug','getting_all_users','getting_roll_id','a_user_api_bearer_token','slug_id','find_org_user_email','int_t_user_manager_assign'));
    //      } // second if close
    //      return view('user/interval_task',compact('org_slug', 'getting_all_users','getting_roll_id','a_user_api_bearer_token','slug_id','find_org_user_email'));
    //      // open condition close
    //     }

    //     }
    public function index($org_slug)
    {
        $authId = Auth::user()->id;
        $a_user_api_bearer_token = $this->getIntTaskAccessToken();
        Log::info('we are in project controller slugwithdashboard function'.$org_slug);
        $findingSlugName = $org_slug;
        $apicontroller = new OrganisationApiController();
        Log::info(' we are in project controller OrganisationApiController:');
        $userOrgId = $apicontroller->getSlugIdOrganisation($findingSlugName,$authId);
        Log::info('we are in  project controller slugwithdashboard 03-02-2022 function :');
        $getting_roll_id = $userOrgId['slug_based_rollId'];
        $block_or_blocked = $userOrgId['slug_based_status'];
        $slug_id = $userOrgId['slug_based_u_org_organization_id'];
        Log::info('we are finding project controller roll id : '.$getting_roll_id);
        Log::info('we are fetching project controller status : '.$block_or_blocked);

        $user_id = Auth::user()->id;
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

        $userorg_list = Organisation::where('org_slug',$org_slug)->first();
        $slug_name_find = $userorg_list['id'];
        $org_id = $userorg_list['id']; 
        
        $project_getting_user_manager = Usersorganization::select('u_org_user_email')->where('u_org_organization_id',$slug_name_find)->where('u_org_organization_id',$org_id)->where('u_org_user_email','!=' , NULL)->GroupBy('u_org_user_email')
        ->get(); 
        Log::info('project main assign organization main  in admin page -> ');
        // ========= on taskboard page email will be display  close
        // ========= project manager will be display who is assign for this slug name open
        $manager_rol = '2';
        Log::info('org_id '.$org_id);
        $project_managers = Usersorganization::where('u_org_organization_id',$org_id)->where('u_org_user_email','!=' ,NULL)->where('u_org_role_id',$manager_rol)->get();
        Log::info('project_managers organization main email find ho gaya');
        // ========= project manager will be display who is assign for this slug name close
          if($getting_roll_id ==1){
            Log::info(' if ke ander role id le kr aaa rha hai tas page project controller');
              return view('pages.interval_task',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','project_managers','project_getting_user_manager')); 
          }
          if($getting_roll_id ==2){
              return view('manager/interval_task',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','project_managers'));
          } 
          return view('user/interval_task',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','project_managers'));
          }
        
      
    }
        // for generate token
        private function getIntTaskAccessToken(){
            $currentLoggedInUser = Auth::user();
            $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
            return $a_user_api_bearer_token;
        }
}
