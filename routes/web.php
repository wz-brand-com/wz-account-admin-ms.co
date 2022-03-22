<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   
       return view('index');
});

Route::get('/login', function () {
    
    return view('welcome');
});

Route::get('/services', 'GuestController@service')->name('service');
Route::get('/gallery', 'GuestController@gallery')->name('gallery');
Route::get('/about-us', 'GuestController@about')->name('about');
Route::get('/contact-us','ContactController@contactform')->name('contact-form');
Route::post('/contact-us','ContactController@store')->name('contact-form.store');
// dashboard organization open

Route::get('orgslist','GuestController@organization_list_dashboard')->name('organzations.list.all');

route::get('member-register/{validToken}/{email}','Auth\RegisterController@memberpage');
route::post('member','Auth\RegisterController@memberstorebymail')->name('member.token.email');
Route::get('welcometo','Auth\RegisterController@welcomtoOrga');

Auth::routes();
// ########## register validation with Userorganization open
Route::get('/register',  'AuthController@registrationForm');
Route::post('/register',  'AuthController@registerUser');
Route::get('accessdenied','AuthController@accesserror');
// ########## register validation with Userorganization close



Route::get('org','Auth\RegisterController@memberstorebymail');


Route::get('/organisation','HomeController@orgpages')->name('orgspages');

// Route::post('org','HomeController@org_stores')->name('org-store');
Route::get('orgs','HomeController@addoragnization')->name('orgs-add');
Route::get('orgs/{org_slug}/dashboard','HomeController@slugwithdashboard')->name('slugdashboard');
Route::get('account_admin/zerodashboard', 'HomeController@zerodashboard')->name('accountadmin.zerodashboard');
Route::get('orgs-edit/{id}','HomeController@edit_orgs');
Route::post('orgs-edit/udpate/{id}','HomeController@update_orgs')->name('orgs-update');

// del orgs open
Route::post('orgs/{id}','HomeController@delOrganization')->name('admin.orgs.destroy');
// del orgs close

// by amit open
route::get('/user/activation/{validToken}/{getting_mail}/{getting_name}','Auth\RegisterController@userActivation');
route::post('/user/activation/store','Auth\RegisterController@userActivateStore')->name('activate.store');
Route::get('auth/verify', 'Auth\RegisterController@verify')->name('verify-user');

// by amit close
// manual  filter in orgs page open
Route::get('orgsfilter/','HomeController@orgs_fetch_data');
// manual  filter in orgs page clsoe
// Admin View Route

Route::get('admin/index','Admin\AdminController@index')->name('admin.index');
Route::get('orgs/{org_slug}/member','Admin\ManagerController@index')->name('managerwithslug');
Route::get('orgs/members/{org_slug}','Admin\ManagerController@memberAll_list_with_org');

// All organization list open
Route::get('orgs/list/{org_slug}','Admin\ManagerController@All_list_Org')->name('list_org');
Route::get('orgs/lists/{org_slug}','Admin\ManagerController@All_list_Org_withdashboard');
// All organization list close

Route::post('members/store','Admin\ManagerController@member_store')->name('managerstore');
Route::get('member_active_deactive_user/{id}','Admin\ManagerController@member_active_deactive_user')->name('memberedit');
Route::post('managers/update','Admin\ManagerController@member_update')->name('memberupdate');
// user invited and removed open
Route::get('member_invited_removed_user/{id}','Admin\ManagerController@m_invited_removed_user')->name('m_edit');
Route::get('/auto-complete-search-query', 'Admin\ManagerController@query')->name('autocomplete.search.query');
// user invited and removed close
Route::get('managers/del/{id}','Admin\ManagerController@member_del')->name('memberdel');
Route::get('orgs/{org_slug}/task','Admin\TaskController@index')->name('taskwithslug');
Route::get('orgs/{org_slug}/project','Admin\ProjectController@index')->name('projectwithslug');
Route::get('orgs/{org_slug}/usermanager','Admin\UserManagerController@index')->name('usermanagerwithslug');
Route::get('orgs/{org_slug}/user','Admin\AgentController@index')->name('userwithslug');
Route::get('orgs/{org_slug}/addurl','Admin\LinkController@index')->name('addurlwithslug');
Route::get('orgs/{org_slug}/keyword','Admin\KeywordController@index')->name('keywordwithslug');
Route::get('orgs/{org_slug}/teamrating/','Admin\RatingController@index')->name('teamratingwithslug');
Route::get('admin/accountadmin/index', 'Admin\AccountAdminController@index')->name('admin.accountadmin.index');
Route::get('orgs/{org_slug}/pagerank','Admin\PagerankController@index')->name('pagerankwithslug');
Route::get('orgs/{org_slug}/websiterank','Admin\WebrankController@index')->name('webrankwithslug');
Route::get('orgs/{org_slug}/socialrank','Admin\SocialrankController@index')->name('socialrankwithslug');
Route::get('orgs/{org_slug}/websiteaccess','Admin\WebAccessController@index')->name('webaccesswithslug');
Route::get('orgs/{org_slug}/email','Admin\EmailController@index')->name('emailwithslug');
Route::get('orgs/{org_slug}/phonenumber','Admin\PhoneNumberController@index')->name('phonenumberwithslug');
Route::get('orgs/{org_slug}/intervaltask','Admin\IntervalTaskController@index')->name('intervaltask');
Route::get('orgs/{org_slug}/taskboard','Admin\TaskboardController@index')->name('taskboardwithslug');

// view profile open
Route::get('orgs/{org_slug}/viewprofile','Admin\ViewprofileController@index')->name('viewprofilewithslug');
Route::get('viewprofile/edit/{id}','Admin\ViewprofileController@edit');
Route::post('viewprofile/update/','Admin\ViewprofileController@update');
Route::get('viewprofile/edit_user_pic/{id}','Admin\ViewprofileController@edit_profile_pic');
Route::post('viewprofile/update_user_pic','Admin\ViewprofileController@update_profile_pic');
Route::post('/addprofile/social-url','Admin\ViewprofileController@addProfileWithSlug');
Route::get('/user_edit_profiles/{user_profile_id}','Admin\ViewprofileController@editprofile');
Route::post('/user_edit_profiles/update','Admin\ViewprofileController@update_add_profile')->name('addurl.update');
Route::get('users/','Admin\ViewprofileController@userProfileDashboard')->name('user-profile');
Route::get('/users/profile/{id}/{user_name}','Admin\ViewprofileController@profileViewwithslug')->name('user-profile-view');
// menual search open
Route::get('welcome_manualfilter','Admin\ViewprofileController@manualSearch');

// view profile controller close
// first time image change open  
Route::get('viewprofile/first_change_edit_user_pic/{id}','Admin\ViewprofileController@edit_profile_change_pic');
Route::post('viewprofile/update_user_change_pic','Admin\ViewprofileController@update_profile_chnage_pic');
// first time image change close


// wizard open
route::get('orgs/{org_slug}/wizard','Admin\WizardProjectController@index')->name('wizard_slug');
Route::get('orgs/{org_slug}/create-step-one', 'Admin\WizardProjectController@createStepOne')->name('products.create.step.one');
Route::get('/orgs/{org_slug}/start-wizard/{project_name}/{id}', 'Admin\WizardProjectController@targetwizardproject')->name('wizard_slugs');

// wizard close
// pie chart open
Route::get('orgs/{org_slug}/pie','admin\PieChartController@index');
// pie chart close
Route::get('auth/google', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\RegisterController@handleProviderCallback');
Route::get('/privacy-policy','GuestController@privacypolicy')->name('privacy-policy');







