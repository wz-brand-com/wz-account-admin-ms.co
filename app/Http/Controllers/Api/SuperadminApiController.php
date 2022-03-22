<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Organisation as OrganisationResource;
use Illuminate\Support\Facades\Log;
use App\Mail\WithOutOrganizatioUser;
use Illuminate\Support\Facades\Mail;
use App\Organisation;
use App\Usersorganization;

use App\Verifytoken;
use App\User;
use Validator;
use DB;
use Hash;


class SuperadminApiController extends Controller
{
    public function index()
    {
        Log::info('This is SuperadminApiController');
        $addnewuser = User::all();
        $response = [
            'success' => true,
            'data' => UserResource::collection($addnewuser),
            'message' => 'AddnewUser retrieved successfully.',
            // 'count' => count($addnewuser)
        ];
        return response()->json($response, 200);
    }
    

    public function store(Request $request)
    {
        Log::info('In SuperadminapiController store method');
        Log::info($request);
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
          
            ]);

         if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 422);
        }
        else {
                $autogen = rand();
                Log::info('auto generate password ' .$autogen);
                $email_check =User::where('email','=',$input['email'])->first();
                if($email_check === NULL){
                Log::info('Adding New User');
                $addnewuser = User::create([
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'password' => Hash::make($autogen),
                     ]);
                Log::info('user store ho gaya ' .$addnewuser);    
                $response = [
                    'success' => true,
                    //'data' => $data,
                    'data' =>new UserResource($addnewuser),
                    'message' => 'Add New User stored successfully.'
                ];
                // send mail to account Admin
                $validToken = sha1(time()) . rand();
                $verifycoursetoken = new Verifytoken();
                $verifycoursetoken->token =  $validToken;
                $verifycoursetoken->email = $input['email'];
                $verifycoursetoken->save();
                Log::info("token save ho rha hai" . $validToken);

                $without_orgnization_user = array(
                    'name' => $request->name,    
                    'email' => $request->email, 
                    'token' =>  $validToken,
                   );
                   
                Mail::to($without_orgnization_user['email'])->send(new WithOutOrganizatioUser($without_orgnization_user, $validToken));
                Log::info('mail has been send by site admin ');
                // send mail to account stop
               }  
               else{
                $response = [
                    'success' => false,
                    'data' => '',
                    'message' => ' Email Id Allready Exist'
                ];
               }
              
                return response()->json($response, 200);
        }
    }

    // function for add block user 
    public function superadmin_active_deactive_user($id)
    {
        Log::info("super admin ka ye id hai = ". $id);
        $user = User::find($id);
        Log::info("id find ho gaya hai");
        if($user->status == 0) {
            $user->status = '1';
            Log::info("status ka value change ho gaya");
        }
         else{
            $user->status = '0';
         }             
          
         
        $user->save();
        Log::info("status change ho gya");
       $response = [
        'success' => true,
        'data' => $user,
        'message' => 'Action Done.',
        ];
        Log::info('response chala gya ');
       
    }
    
    // add block user end

    // edit function account admin open
    public function accounts_admin_edit($id){
        $users = User::find($id);
        Log::info('on this function accounts_admin_edit '.$id);
        if (is_null($users)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'users not found.'
            ];
            return response()->json($response, 404);
        } else {
            $response = [
                'success' => true,
                'data' =>new UserResource($users),
                'message' => 'user retrieved successfully.'
            ];
                return response()->json($response, 200);
        }
    }
    // edit function account admin close

    #################### update function open #######################################
    public function accounts_admin_update(Request $request){
        Log::info('now we are in this funtion accounts_admin_update ' .$request);
        $rules = array(
            'email' => 'required',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
             $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 422);
        }
        $update_user = User::where('name',$request['name'])->where('email','=',$request['email'])->first();
        if($update_user === null){
            $form_data = array(
                'email'  => $request->email,
                'name'  => $request->name,
               );
               User::whereId($request->admin_hidden_id)->update($form_data);
               $response = [
                            'success' => ' update successfully.',
                            'message' => ' update successfully',
                        ];
            // return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'data' => '',
                'message' => ' Email Already Exist.',
            ];
            Log::info('else ke ander aaa gaye hai');  
        }
        return response()->json($response, 200);
     
    }

####################  update function page end #######################################

    public function get_organization_list(Request $request){
        
        Log::info('now we are  in get organization list function');
        $get_orgs = Organisation::all();
        Log::info('get organization value ' . $get_orgs);
        $response = [
            'success' => true,
            'data' => OrganisationResource::collection($get_orgs),
            'message' => 'get_orgs retrieved successfully.',
            // 'count' => count($get_orgs)
        ];
        return response()->json($response, 200);
        
    }
}
