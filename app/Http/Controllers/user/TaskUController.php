<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organisation;
use App\Usersorganization;
use Log;
use Auth;

class TaskUController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($slug)
    {
        $org = Organisation::where('slug',$slug)->first();
        $user_id = $org['user_id'];
        $org_id = $org['id'];
        $slug_id = $org['id'];
        Log::info('slug ka id aaa rha hai'.$slug_id);
        $org_users = Usersorganization::where('user_id',$user_id)->where('organization_id',$org_id)->first();
        Log::info('task controller main value aa gaya'.$org_users);
         $a_user_api_bearer_token = $this->getTaskAccessToken();
        return view('user.task', [
            'a_user_api_bearer_token' => $a_user_api_bearer_token,
            'slug' => $slug,
            'slug_id' => $slug_id,
           
        ]);
    }

    private function getTaskAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
}
