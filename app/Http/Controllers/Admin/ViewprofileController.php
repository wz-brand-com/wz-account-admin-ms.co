<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PasswordChangeSendMail;
use App\Organisation;
use App\Addprofile;
use App\User;
use App\Usersorganization;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Validator;
use DB;
use App\City;
use App\State;
use App\Country;

class ViewprofileController extends Controller
{
    public static function index($org_slug)
    {
        $users = User::where('id', '=', auth()->user()->id)->first();
        $org = Organisation::where('org_slug', $org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $slug_id = $org['id'];
        $org_users = Usersorganization::where('u_org_user_id', $user_id)->where('u_org_organization_id', $org_id)->first();
        $profile_user_url = Addprofile::where('user_id',$user_id)->first();
        Log::info('we are getting '.$profile_user_url);

        $profile_getting = Addprofile::where('user_id',$user_id)->first();

        $country_id = $profile_getting['country_id'];
        Log::info('now get country_id ka value'.$country_id);
        $country = Country::where('country_id',$country_id)->first();
        $get_country_name = $country['country_name'];
        Log::info(' getting country name '.$get_country_name);

        $state_id = $profile_getting['state_id'];
        $state = State::where('state_id',$state_id)->first();
        $get_state_name = $state['state_name'];
        Log::info(' getting state name '.$get_state_name);

        $city_id = $profile_getting['city_id'];
        $city = City::where('city_id',$city_id)->first();
        $get_city_name = $city['city_name'];
        Log::info(' getting city name '.$get_city_name);

        // ################# if condition apply for checking if organization has been blocked not allow to access dashboard
        $block_or_blocked = $org_users['status'];
        $user_account_block = User::where('id', $user_id)->first();
        $block_user = $user_account_block['status'];

        if ($block_or_blocked == 1) {
            Log::info('organizatio block ho gaya hai');
            return view('admin/block-organization');
        }
        if ($block_user == 1) {
            Log::info('user account block ho gaya hai');
            return view('admin/status-blocked');
        }
        if ($block_or_blocked == null) {
            Log::info('epmty ho gaya status');
            return view('admin/remove-orgs');
        } else {
            // ##################### if condition apply for checking if organization has been blocked not allow to access dashboard

            // open condition open
            $getting_roll_id = $org_users->u_org_role_id;
            if ($getting_roll_id == 1) {
                return view('pages.viewprofile', compact('users', 'org_slug', 'getting_roll_id', 'slug_id','profile_user_url','user_id','get_country_name','get_state_name','get_city_name'));
            } // first if close
            if ($getting_roll_id == 2) {
                return view('manager/viewprofile', compact('users', 'org_slug', 'getting_roll_id', 'slug_id','profile_user_url','user_id','get_country_name','get_state_name','get_city_name'));
            } // second if close
            return view('user/viewprofile', compact('org_slug', 'users', 'getting_roll_id', 'slug_id','profile_user_url','user_id','get_country_name','get_state_name','get_city_name'));
            // open condition close

        }

    }

    public function edit($id)
    {
        $users = User::find($id);
        $response = [
            'success' => true,
            'message' => 'Categoty retrieved successfully for edit.',
            'data' => $users,
        ];
        return response()->json($response, 200);
    }

    // Update function start
    public function update(Request $request)
    {
        $rules = array(
            'password' => 'required',

        );

        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => 'Password already Exist',
            ];
            return response()->json($response, 422);
        }
        $email_check = User::where('password', '=', $request->password)->first();
        if ($email_check === null) {
            $form_data = array(
                'name' => $request->name,
                // 'email'     => $request->email,
                'password' => Hash::make($request->password),
            );
            User::whereId($request->hidden_id)->update($form_data);
            $response = [
                'success' => true,
                'message' => 'Password has been change successfully.',
            ];
            // messege will be send after change the password open
            $passwordChangeSendMail = array(
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'daymonth' => $request->daymonth,
            );
            Mail::to($passwordChangeSendMail['email'])->send(new PasswordChangeSendMail($passwordChangeSendMail));
            // messege will be send after change the password close

        } else {
            $response = [
                'success' => false,
                'data' => '',
                'message' => 'Password already exist !.',
            ];
        }

        return response()->json($response, 200);
    }

    //  first time change pic edit function open
    public function edit_profile_change_pic($id)
    {
        $users = User::find($id);
        $response = [
            'success' => true,
            'message' => 'Avatar has been change successfully.',
            'data' => $users,
        ];
        return response()->json($response, 200);
    }
    //  first time change pic  edit function close edit_profile_change_pic
    // first time image pic update open
    public function update_profile_chnage_pic(Request $request)
    {
        $rules = array(
            'file_pic' => 'required',

        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => 'Please fill required field',
            ];
            return response()->json($response, 422);
        }
        if ($request->hasFile('file_pic')) {

            $profile_pic_user = time() . '.' . $request['file_pic']->getClientOriginalExtension();
            $request['file_pic']->move(base_path() . '/storage/app/public/images', $profile_pic_user);
        } else {
            $profile_pic_user = $request->profile_pic_user;
        }
        $form_data = array(
            'file_pic' => $profile_pic_user,

        );
        User::whereId($request->hidden_id_edit_chnage_profile)->update($form_data);
        $response = [
            'success' => true,
            'message' => 'Avatar has been change successfully.',
        ];

        return response()->json($response, 200);
    }
    // first time image pic update close

    //  profile pic edit function open
    public function edit_profile_pic($id)
    {
        $users = User::find($id);
        $response = [
            'success' => true,
            'message' => 'Avatar has been update successfully.',
            'data' => $users,
        ];
        return response()->json($response, 200);
    }
    //  profile pic  edit function close update_profile_pic

    // update profile pic open
    public function update_profile_pic(Request $request)
    {

        $userid = Auth::User()->id;
        $gettingfile = User::where('id', $userid)->first();
        $user_pic = $gettingfile->file_pic;
        $rules = array(
            'file_pic' => 'required',

        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => 'Please fill required field',
            ];
            return response()->json($response, 422);
        }
        if ($request->hasFile('file_pic')) {

            unlink(base_path() . '/storage/app/public/images/' . $user_pic);
            $profile_pic_user = time() . '.' . $request['file_pic']->getClientOriginalExtension();
            $request['file_pic']->move(base_path() . '/storage/app/public/images', $profile_pic_user);
        } else {
            $profile_pic_user = $request->profile_pic_user;
        }

        $form_data = array(
            'file_pic' => $profile_pic_user,

        );
        User::whereId($request->hidden_id_edit_profile)->update($form_data);
        $response = [
            'success' => true,
            'message' => 'Avatar has been update successfully.',
        ];

        return response()->json($response, 200);
    }
    // update profile pic close

    // addprofile open
    public function addProfileWithSlug(Request $request){

        $input = $request->all();
        $getting_id = Auth::user()->id;
        log::info("user id me kya aa rha hai.".$getting_id);

        $adding_profile = Addprofile::where('user_id', $getting_id)->first();
        $newuser = new Addprofile();
        $newuser = $adding_profile;
        $newuser = $newuser->fill($input);
        $newuser->user_id = $getting_id;
        $newuser->save();

        $validator = Validator::make($input,[
            'facebook' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'wordpress' => 'required',
            'tumblr' => 'required',
            'instagram' => 'required',
            'quora' => 'required',
            'pinterest' => 'required',
            'reddit' => 'required',
            'koo' => 'required',
            'scoopit' => 'required',
            'slashdot' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $response = [
            'success' => true,
            'message' => 'Profile stored successfully.',
        ];
        return response()->json($response, 200);

    }
    // addprofile close

    public function editprofile($user_profile_id){
        Log::info('user_profile_id ka value '.$user_profile_id);
        $url = Addprofile::where('user_id',$user_profile_id)->first();
        Log::info('user profile id find'.$url);
        if (is_null($url)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'URL not found.',
            ];
            return response()->json($response, 404);
        } else {
            $response = [
                'success' => true,
                'data' => $url,
                'message' => 'url retrieved successfully.',
            ];
            return response()->json($response, 200);
        }
    }


    public function update_add_profile(Request $request)
    {
        $input = $request->all();
        $getting_id = Auth::user()->id;
        log::info("user id me kya aa rha hai.".$getting_id);

        $adding_profile = Addprofile::where('user_id', $getting_id)->first();
        $newuser = new Addprofile();
        $newuser = $adding_profile;
        $newuser = $newuser->fill($input);
        $newuser->user_id = $getting_id;
        $newuser->save();

        $validator = Validator::make($input,[
            'facebook' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'wordpress' => 'required',
            'tumblr' => 'required',
            'instagram' => 'required',
            'quora' => 'required',
            'pinterest' => 'required',
            'reddit' => 'required',
            'koo' => 'required',
            'scoopit' => 'required',
            'slashdot' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $response = [
            'success' => true,
            'message' => 'Url updated successfully.',
        ];
        return response()->json($response, 200);
    }


     public function userProfileDashboard(){

         $data = DB::table('addprofiles')
        ->leftJoin('countries','addprofiles.country_id', '=','countries.country_id')
        ->leftJoin('states','addprofiles.state_id', '=','states.state_id')
        ->leftJoin('cities','addprofiles.city_id', '=','cities.city_id')
        ->select('addprofiles.*','countries.country_name','states.state_name','cities.city_name')
        ->orderBy('id', 'desc')->get();
         return view('publicview',compact('data'));
    }


    public function profileViewwithslug($id,$user_name)
    {
        Log::info('we are getting user profile user id '.$id);
        $user_slug_image = User::where('id',$id)->first();
        $slug_image = $user_slug_image['file_pic'];

        Log::info('we are sluged based image '.$slug_image);

        $url = Addprofile::where('user_name',$user_name)->where('id',$id)->first();

        $profile_getting = Addprofile::where('id',$id)->first();
        $country_id = $profile_getting['country_id'];
        Log::info('now get country_id ka value'.$country_id);
        $country = Country::where('country_id',$country_id)->first();
        $get_country_name = $country['country_name'];
        Log::info(' getting country name '.$get_country_name);
        $state_id = $profile_getting['state_id'];
        $state = State::where('state_id',$state_id)->first();
        $get_state_name = $state['state_name'];
        Log::info(' getting state name '.$get_state_name);
        $city_id = $profile_getting['city_id'];
        $city = City::where('city_id',$city_id)->first();
        $get_city_name = $city['city_name'];
        Log::info(' getting city name '.$get_city_name);
        $url = Addprofile::where('user_name',$user_name)->where('id',$id)->first();
        return view('user-view',compact('profile_getting','get_country_name','get_state_name','get_city_name','slug_image'));
     }


         //  manual search in public view pages
        public function manualSearch(Request $request){

                $country_id = $request->get('filter_by_country');
                Log::info($country_id .'$country_id fetchjobsdata ka data hai');
                $state_id = $request->get('filter_by_state');
                Log::info($state_id .'$state_id fetchjobsdata ka data hai');
                $city_id = $request->get('filter_by_city');
                Log::info($city_id .'$city_id fetchjobsdata ka data hai');
                $search = $request->get('filter_by_search');
                Log::info($search .'$search fetchjobsdata ka data hai');
                $search = str_replace("","%",$search);
                   if($country_id != "all"){
                     $data = DB::table('addprofiles')
                     ->leftJoin('countries','addprofiles.country_id', '=','countries.country_id')
                     ->leftJoin('states','addprofiles.state_id', '=','states.state_id')
                     ->leftJoin('cities','addprofiles.city_id', '=','cities.city_id')
                     ->select('addprofiles.*','countries.country_name','states.state_name','cities.city_name')
                     ->where('addprofiles.country_id', $country_id)
                     ->orderBy('id', 'desc')->get();
                     // Log::info($data .'$data fetchjobsdata ka country data hai');
                 } else if($state_id != "all"){
                     $data = DB::table('addprofiles')
                     ->leftJoin('countries','addprofiles.country_id', '=','countries.country_id')
                     ->leftJoin('states','addprofiles.state_id', '=','states.state_id')
                     ->leftJoin('cities','addprofiles.city_id', '=','cities.city_id')
                     ->select('addprofiles.*','countries.country_name','states.state_name','cities.city_name')
                     ->where('addprofiles.state_id', $state_id)
                     ->orderBy('id', 'desc')->get();
                     // Log::info($data .'$data fetchjobsdata ka state data hai');
                } else if($city_id != "all"){
                     $data = DB::table('addprofiles')
                     ->leftJoin('countries','addprofiles.country_id', '=','countries.country_id')
                     ->leftJoin('states','addprofiles.state_id', '=','states.state_id')
                     ->leftJoin('cities','addprofiles.city_id', '=','cities.city_id')
                     ->select('addprofiles.*','countries.country_name','states.state_name','cities.city_name')
                     ->where('addprofiles.city_id', $city_id)
                     ->orderBy('id', 'desc')->get();
                     // Log::info($data .'$data fetchjobsdata ka city data hai');
                 }else if($search != "") {
                    $data = DB::table('addprofiles')
                     ->leftJoin('countries','addprofiles.country_id', '=','countries.country_id')
                     ->leftJoin('states','addprofiles.state_id', '=','states.state_id')
                     ->leftJoin('cities','addprofiles.city_id', '=','cities.city_id')
                     ->select('addprofiles.*','countries.country_name','states.state_name','cities.city_name')
                     ->where('addprofiles.id', 'like', '%'.$search.'%')
                     ->orWhere('addprofiles.user_name', 'like', '%'.$search.'%')
                     ->orWhere('countries.country_name', 'like', '%'.$search.'%')
                     ->orWhere('states.state_name', 'like', '%'.$search.'%')
                     ->orWhere('cities.city_name', 'like', '%'.$search.'%')
                     ->orderBy('addprofiles.id', 'desc')->get();
                     Log::info($data .'$data fetchjobsdata ka search data hai');
                } else{
                    $data =  DB::table('addprofiles')
                     ->leftJoin('countries','addprofiles.country_id', '=','countries.country_id')
                     ->leftJoin('states','addprofiles.state_id', '=','states.state_id')
                     ->leftJoin('cities','addprofiles.city_id', '=','cities.city_id')
                     ->select('addprofiles.*','countries.country_name','states.state_name','cities.city_name')
                    ->orderBy('id', 'desc')->get();
                    Log::info('$data fetchjobsdata ka last addprofiles  data hai');
                }
                 return view('paginated_data',compact('data'))->render();
             }



    }




