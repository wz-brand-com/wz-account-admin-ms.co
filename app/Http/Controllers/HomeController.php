<?php

namespace App\Http\Controllers;

use DB;
use Log;

use App\User;
use Redirect;
use App\TasksBoard;
use App\AddurlCount;
use App\Organisation;
use App\ProjectCount;
use App\WebrankCount;
use App\Tasktypecount;
use App\SocialRankCount;
use App\TeamRatingCount;
use App\IntervalTaskCount;
use App\Usersorganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\LinkApiController;
use App\Http\Controllers\Api\RatingApiController;
use App\Http\Controllers\Api\KeywordApiController;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\WebrankApiController;
use App\Http\Controllers\Api\OrganisationApiController;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function zerodashboard()
    {
        return view('admin.zerodashboard');
    }

    public function orgpages()
    {   
        $a_user_api_bearer_token = $this->getOrganisationAccessToken();
        return view('admin.orgs', compact('a_user_api_bearer_token'));
    }

   

    public function addoragnization()
    {
        if (Auth::user()->status == 1) {
            Log::info('account block ho gaya hai');
            return view('admin/status-blocked');
        } else {
            $organizations = Auth::user()->id;
            $org_users = Usersorganization::where('u_org_user_id', $organizations)->get();
            $getting_org_users = Usersorganization::where('u_org_user_id', $organizations)->first();
            $getting_org_value = $getting_org_users['u_org_organization_id'];
            if ($getting_org_value != null) {
                foreach ($org_users as $or_user) {
                    $or_id = $or_user['u_org_organization_id'];
                    $myOrId[] = $or_id;
                }
                $org_user_list = Organisation::whereIn('id', $myOrId)->orderBy('id', 'DESC')->paginate(500);
                $a_user_api_bearer_token = $this->getOrganisationAccessToken();
                return view('admin/organisation', compact('org_user_list','a_user_api_bearer_token'));
            } else {
                Log::info('we are in else condition of this function addoragnization');
                return view('admin/remove-orgs');
            }
        }

    }

    // after choose organization then continue with role based display dashbboard open
    public function slugwithdashboard($org_slug)
    {
        $authId = Auth::user()->id;
        Log::info('slugwith dashboard' .$org_slug);
        $findingSlugName = $org_slug;
        $apicontroller = new OrganisationApiController();
        $userOrgId = $apicontroller->getSlugIdOrganisation($findingSlugName,$authId);
        $getting_roll_id = $userOrgId['slug_based_rollId'];
        Log::info('user roll id'.print_r($getting_roll_id,true));
        $block_or_blocked = $userOrgId['slug_based_status'];
        Log::info('user status id'.print_r($block_or_blocked,true));


        $id = Auth::user()->id;
        $urlCount = new LinkApiController();
        $getUrlCount = $urlCount->getUrl($id);
        $get_sluged_based_url =$getUrlCount['url_count'];

        $teamRating = new RatingApiController();
        $getrating =  $teamRating->getRating($id);
        $get_value_rating = $getrating['slug_based_rating'];

        $slug_id = $id;
        $project = new ProjectApiController();
        $getProjectCount = $project->getProject($slug_id);
        $count_projectData = $getProjectCount['count_project'];
       
        $websiteRank = new WebrankApiController();
        $getWebsiteRank = $websiteRank->getWebrank($id);
        $get_website_rank = $getWebsiteRank['webCount'];
       
        $getkeyword = new KeywordApiController();
        $getKeywordCount = $getkeyword->getKeyword($id);
        $get_keyword_count = $getKeywordCount['keywordCount'];
           
        $login_user_id = Auth::user()->id;
        $user_account_block = User::where('id',$login_user_id)->first();
        $block_user = $user_account_block['status'];

        if($block_or_blocked == 1){
            Log::info('organizatio block ho gaya hai');
            return view('admin/block-organization'); 
        }
        if($login_user_id === 1){
            Log::info('user account block ho gaya hai');
            return view('admin/status-blocked'); 
        }
        if($block_or_blocked == NULL){
            Log::info('epmty ho gaya status');
            return view('admin/remove-orgs');
        }
        else{

            if ($getting_roll_id == 1) {
                Log::info('we are in if condition of this function slugwithdashboard');
                return view('admin/ad-dashboard', compact('org_slug', 'getting_roll_id', 'find_org_in_manager_page_count', 'get_sluged_based_url','get_value_rating','count_projectData','get_website_rank','get_keyword_count'));
            } // first if close
            elseif ($getting_roll_id == 2) {
                Log::info('we are in elseif condition of this function manager dashboard');
                return view('manager/managerdashboard', compact('org_slug', 'getting_roll_id', 'get_sluged_based_url','get_value_rating','count_projectData','get_website_rank','get_keyword_count'));
            }
            else{
                return view('user/userdashboard', compact('org_slug', 'getting_roll_id','get_sluged_based_url','get_value_rating','count_projectData','get_website_rank','get_keyword_count'));
            } 
        }
               

    }
    // after choose organization then continue with rolebased display dashbboard open


    public function update_orgs(Request $request, $id)
    {
        $request->validate([
            'org_name' => 'required|unique:organisations,org_name|min:2|max:150',
        ]);

        Log::info('update click krne pe ye value aaa rhaa hai');
        $org_update_authrized = Organisation::where('id', $id)->first();
        Log::info('validate orgs click krne pe ye value aaa rhaa hai');
        $getting_slugs = $request->org_name;
        // strip out all whitespace
        $name_cleans = preg_replace('/\s*/', '', $getting_slugs);
        // convert the string to all lowercase
        $convert_slug_lower = strtolower($name_cleans);
        // $org_update_authrized->update($request->all());
        $org_update_authrized->org_slug = $convert_slug_lower;
        Log::info('$org_update_authrized');
        $org_update_authrized->org_name = $getting_slugs;
        $org_update_authrized->update();
        return redirect('orgs')->with('success', 'Organization has been Updated! Successfully ');
    }

    public function delOrganization($id)
    {
        $find_org = Usersorganization::where('u_org_organization_id', $id)->get();
        $find_org_del = Usersorganization::where('u_org_organization_id', $id)->first();
        if (count($find_org) < 2) {
            Log::info('if ke ander aa gaye hai with count ke saath');
            $org_update_authrized = Organisation::where('id', $id)->first();
            $org_update_authrized->delete();
            Log::info('org_update_authrized  Organisation model se delete ho gaya ');
            return redirect('orgs')->with('success', 'Organization has been deleted successfully');
        } else {
            log::info('else ke part main aa gaye hai Organisation from cannot delete this orga');
            return redirect('orgs')->with('message', 'Organization Cannot be delete ');

        }

        return redirect('orgs')->with('danger', 'Organization Organization Cannot delete ');
    }

    public function wizardGet($org_slug)
    {
        $org = Organisation::where('org_slug', $org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $getting_roll_id = '1';
        Log::info('org_id main  kiya aa rha hai');
        $org_user = Usersorganization::where('u_org_user_id', $user_id)->where('u_org_organization_id', $org_id)->first();
        return view('user/wizard', compact('org_user', 'org_slug', 'getting_roll_id'));
    }


    private function getOrganisationAccessToken(){
        $currentLoggedInUser = Auth::user();
        $a_user_api_bearer_token = $currentLoggedInUser->createToken('a_user_api_token')-> accessToken;
        return $a_user_api_bearer_token;
    }
 
   
   
}
