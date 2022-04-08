<?php

namespace App\Http\Controllers\Admin;

use DB;
use Log;
use Auth;
use App\Role;
use App\User;
use Validator;
use App\Organisation;
use App\Usersorganization;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteMemberNotExistMail;
use App\Mail\InviteMemberExistMail;
use App\Verifytoken;

use App\Notexistmemberverifycoursetoken;
use App\Http\Controllers\Api\OrganisationApiController;
use App\Http\Resources\Usersorganization as UsersorganizationResource;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index($org_slug)
    // {
    //     $authId = Auth::user()->id;
    //     if(Auth::user()->status == 1){
    //         Log::info('account block ho gaya hai');
    //         return view('admin/block-organization'); 
    //     }else{
    //     $findingSlugName = $org_slug;
    //     $apicontroller = new OrganisationApiController();
    //     $userOrgId = $apicontroller->getSlugIdOrganisation($findingSlugName,$authId);
    //     $getting_roll_id = $userOrgId['slug_based_rollId'];
    //     $block_or_blocked = $userOrgId['slug_based_status'];
    //     $slug_id = $userOrgId['slug_based_u_org_organization_id'];
    //     $getOrgBasedWithRollIdDashboard = $org_slug;
    //     Log::info('khud ka controller main kiya vlaue aa rha hai');
    //     $gettingUserOnSlugBased = $apicontroller->getInvitedUserDasboard($getOrgBasedWithRollIdDashboard);
    //     $fetching_user = $gettingUserOnSlugBased['getOrgUserName'];
    //     Log::info('ManagerController main value aa gaya');
    //     $getting_all_users = User::all();
    //     $rolles = Role::all();     
    //     $user_id = Auth::user()->id;
    //     $user_account_block = User::where('id',$user_id)->first();
    //     $block_user = $user_account_block['status'];
         
    //      if($block_or_blocked == 1){
    //          Log::info('organizatio block ho gaya hai');
    //          return view('admin/block-organization'); 
    //      }
    //      if($block_user == 1){
    //        Log::info('user account block ho gaya hai');
    //          return view('admin/status-blocked'); 
    //      }
    //      if($block_or_blocked == NULL){
    //          Log::info('epmty ho gaya status');
    //          return view('admin/remove-orgs');
    //      }
    //      else{   
      
    //     if($getting_roll_id ==1){
    //         return view('admin.managerindex',compact('rolles','getting_all_users','org_slug','getting_roll_id','slug_id')); 
    //     } // first if close
    //     if($getting_roll_id ==2){
    //         return view('manager/managerindex',compact('rolles','getting_all_users','org_slug','getting_roll_id','slug_id'));
    //     } // second if close
        
    //     return view('user/managerindex',compact('rolles','getting_all_users','org_slug','getting_roll_id','slug_id'));
    //     // open condition close
    // }
    // }

    // }

    public function index($org_slug)
    {
        $authId = Auth::user()->id;
        if(Auth::user()->status == 1){
            Log::info('account block ho gaya hai');
            return view('admin/block-organization'); 
        }else{
        $findingSlugName = $org_slug;
        $apicontroller = new OrganisationApiController();
        $userOrgId = $apicontroller->getSlugIdOrganisation($findingSlugName,$authId);
        $getting_roll_id = $userOrgId['slug_based_rollId'];
        $block_or_blocked = $userOrgId['slug_based_status'];
        $slug_id = $userOrgId['slug_based_u_org_organization_id'];
        $getOrgBasedWithRollIdDashboard = $org_slug;
        Log::info('khud ka controller main kiya vlaue aa rha hai');
        $gettingUserOnSlugBased = $apicontroller->getInvitedUserDasboard($getOrgBasedWithRollIdDashboard);
        $fetching_user = $gettingUserOnSlugBased['getOrgUserName'];
        Log::info('ManagerController main value aa gaya');
        $getting_all_users = User::all();
        $rolles = Role::all();     
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
      $a_user_api_bearer_token = $this->getManagerAccessToken();
        if($getting_roll_id ==1){
            return view('admin.managerindex',compact('rolles','getting_all_users','org_slug','getting_roll_id','slug_id','a_user_api_bearer_token')); 
        } // first if close
        if($getting_roll_id ==2){
            return view('manager/managerindex',compact('rolles','getting_all_users','org_slug','getting_roll_id','slug_id','a_user_api_bearer_token'));
        } // second if close
        
        return view('user/managerindex',compact('rolles','getting_all_users','org_slug','getting_roll_id','slug_id','a_user_api_bearer_token'));
        // open condition close
    }
    }

    }


    // autocomplete search open
     // return search results
     public function query(Request $request)
     {
         $input = $request->all();
 
        //  $data = User::select("name")
         $data_email =  DB::table('users')
            ->where("name", "LIKE", "%{$input['query']}%")
             ->where("email", "LIKE", "%{$input['query']}%")
             ->get();
        Log::info('name ya email nahi rha hai');
         return response()->json($data_email);
     }
    // autocomplete search close

    // public function memberAll_list_with_org($org_slug)
    // {
    //     $userorg_list = Organisation::where('org_slug',$org_slug)->first();
    //     $slug_name_find = $userorg_list['id'];
    //     Log::info('slug name find value');
    //     $self_value = 'self';
    //     $userorg_list_withslug = Usersorganization::where('u_org_organization_id',$slug_name_find)->where('invited_by_email','!=',$self_value)->get();
    //     $response = [
    //         'success' => true,
    //         'data' => $userorg_list_withslug,
    //         'message' => 'Slug Fetching successfully.'
    //     ];
    //     return response()->json($response, 200);
    //     }

    public function memberAll_list_with_org($org_slug)
    {
        $userorg_list = Organisation::where('org_slug',$org_slug)->first();
        $slug_name_find = $userorg_list['id'];
        Log::info('slug name find value');
        $self_value = 'self';
        $userorg_list_withslug = Usersorganization::where('u_org_organization_id',$slug_name_find)->where('invited_by_email','!=',$self_value)->get();
        $response = [
            'success' => true,
            'data' => $userorg_list_withslug,
            'message' => 'Slug Fetching successfully.'
        ];
        return response()->json($response, 200);
        }

    // this function only will be calling page and related some variable open 1
    public function All_list_Org($org_slug)
    { 
        $userorg_list = Organisation::where('org_slug',$org_slug)->first();
        $getting_all_users = User::all();
        $rolles = Role::all();
        // $a_user_api_bearer_token = $this->getManagerAccessToken();
        return view('pages/list',compact('userorg_list','find_org','getting_all_users','rolles','org_slug'));
    }
    // this function only will be calling page and related some variable close 1

    // ALL organization list open 2
    
    public function All_list_Org_withdashboard($org_slug)
    { 
        
        $userorg_list = Organisation::where('org_slug',$org_slug)->first();
        $slug_name_find = $userorg_list['id'];
        $find_org = Usersorganization::where('u_org_organization_id',$slug_name_find)->get();
        $userorg_list_dashboard = DB::table('usersorganizations')->where('invited_by',Auth::user()->id)
        ->leftJoin('roles','usersorganizations.u_org_role_id', '=','roles.id')
        ->leftJoin('users','usersorganizations.u_org_user_id', '=','users.id')
        ->leftJoin('organisations', 'usersorganizations.id', '=', 'organisations.org_user_id')
        ->select('usersorganizations.*','organisations.org_user_email','organisations.org_user_name','roles.role_name','users.name','users.email')
        ->get();
        $getting_all_users = User::all();
        $rolles = Role::all();
        // $a_user_api_bearer_token = $this->getManagerAccessToken();
        

         $response = [
            'success' => true,
            'data' => $userorg_list_dashboard,
            'message' => 'Slug Fetching successfully.'
        ];
        return response()->json($response, 200);
    }
    // ALL organization list clsoe 2


   

    private function getManagerAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }

   
    public function member_store(Request $request){
        Log::info('now in member stote function');
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'u_org_user_email' => 'required|string',
           
        ] );

        if ($validator->fails()) {
            $response = [
                'success' => 'please submit field',
                'data' => 'Validation Error.',
                // 'message' => $msglist 
            ];
            $error['u_org_user_id'] = ["The email was not correct"];
            return response()->json($response,422);  
        }       
        else {
               
      
                $memeberApiController = new OrganisationApiController();
                $email_with_org_sending = $memeberApiController->invited_role_with_org_name($request);
                $gettingUserMailId = $email_with_org_sending['usermail'];
                $gettingUserSlugName = $email_with_org_sending['userSlugName'];
                if($gettingUserMailId != NULL &&  $gettingUserSlugName != NULL){  
                Log::info('ager both value is equal nahi hai to store  hona chaiye');
                    $email_to_name = $input['u_org_user_email'];
                    $gets_email_name = strtok($email_to_name, '@');
                    $GetUperCaseName  = ucwords(strtolower($gets_email_name));
                    $invite_member_exist = array(
                    'invited_by_email' => $input['invited_by_email'],
                    'email' => $input['u_org_user_email'],
                    'u_org_slugname' => $input['u_org_slugname'],
                    'u_org_role_name' => $input['u_org_user_member_role_name'],
                    'name' => $GetUperCaseName,
                    );

                $check_email = User::where('email',$input['u_org_user_email'])->first();
                $getUserName  = $check_email['name'];
                $GetUperCaseName  = ucwords(strtolower($getUserName));
                $ExistOrganizationName =  $request->u_org_slugname;
                if($check_email != NULL){
                    Log::info('in IF condition we got email id in users table in manager controller | ');    
                    $invite_member_exist = array(
                        'invited_by_email' => $input['invited_by_email'],
                        'email' => $input['u_org_user_email'],
                        'u_org_slugname' => $input['u_org_slugname'],
                        'u_org_role_name' => $input['u_org_user_member_role_name'],
                        'name' => $GetUperCaseName,
                    );
                    Log::info('user exist id ');
                    Mail::to($invite_member_exist['email'])->send(new InviteMemberExistMail($invite_member_exist,$ExistOrganizationName));
                
                }else{
                    //    token gen open
                    $validToken=sha1(time()).rand();
                    $verifycoursetoken = new Verifytoken();
                    $verifycoursetoken->token =  $validToken;
                    $verifycoursetoken->email =  $input['u_org_user_email'];
                    $verifycoursetoken->save();
                    Log::info('token save ho gaya');
                    $email_to_name = $input['u_org_user_email'];
                    $gets_email_name = strtok($email_to_name, '@');
                    $upername  = ucwords(strtolower($gets_email_name));
                    $organizationNameforMail =  $request->u_org_slugname;

                    $invite_member_not_exist = array(
                    'invited_by_email' => $input['invited_by_email'],
                    'u_org_slugname' => $input['u_org_slugname'],
                    'email' => $input['u_org_user_email'],
                    'u_org_role_name' => $input['u_org_user_member_role_name'],
                    'validToken' =>  $validToken,
                    'name' =>$upername,
                    );
                    Mail::to($invite_member_not_exist['email'])->send(new InviteMemberNotExistMail($invite_member_not_exist,$validToken,$organizationNameforMail));
                }
          
              $response = [
                'success' => True,
                'data' => $gettingUserSlugName,
                'message' => 'Member stored successfully ',
            ];
            return response()->json($response, 200);
            
            // send mail to account stop
             } // if close

             else{
                $response = [
                    'success' => false,
                    'data' => '',
                    'message' => 'Member already invited for this organization ! ',
                ];
            return response()->json($response, 200);
             }
                
                
        }

    }


    

    

   
    
   
}
