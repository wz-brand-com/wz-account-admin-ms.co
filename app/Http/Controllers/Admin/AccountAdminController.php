<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
class AccountAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $a_user_api_bearer_token = $this->getAccountAdminAccessToken();
        return view('admin.accountadmin.index', [
                        'a_user_api_bearer_token' => $a_user_api_bearer_token
                    ]);
    }
    // for generate token
    private function getAccountAdminAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
}