<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Log;  
use App\User;
use App\Organisation;
use App\Usersorganization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\OrganisationApiController;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($org_slug)
    {
        $authId = Auth::user()->id;
        $a_user_api_bearer_token = $this->getProjectAccessToken();
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
              return view('pages.project',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','project_managers','project_getting_user_manager')); 
          }
          if($getting_roll_id ==2){
              return view('manager/project',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','project_managers'));
          } 
          return view('user/project',compact('org_slug','getting_roll_id','a_user_api_bearer_token','slug_id','project_managers'));
          }
        
      
    }

    private function getProjectAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
}
