<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Organisation;
use App\Usersorganization;
use Log; 

class ProjectUController extends Controller
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
        $org_users = Usersorganization::where('user_id',$user_id)->where('organization_id',$org_id)->first();
        $a_user_api_bearer_token = $this->getProjectAccessToken();
        return view('user.project', [
            'a_user_api_bearer_token' => $a_user_api_bearer_token,
            'slug' => $slug,
            'slug_id' => $slug_id,
            
        ]);
    }

    private function getProjectAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
}
