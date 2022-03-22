<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Organisation;
use App\Usersorganization;
use Log;

class RatingUController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($org_slug)
    {
        $org = Organisation::where('org_slug',$org_slug)->first();
        $user_id = $org['org_user_id'];
        $org_id = $org['id'];
        $slug_id = $org['id'];
        $org_users = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();

        $a_user_api_bearer_token = $this->getProjectAccessToken();
        return view('user.team_rating', [
            'a_user_api_bearer_token' => $a_user_api_bearer_token,
            'org_slug' => $org_slug,
            'slug_id' => $slug_id,
        ]);
    }

    private function getProjectAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
}
