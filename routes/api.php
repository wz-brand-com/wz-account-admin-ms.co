<?php

use Illuminate\Support\Facades\Log;
use App\Usersorganization;
use Illuminate\Support\Facades\Auth;

Route::group(['prefix'=>'v1/j', 'middleware' => 'auth', 'middleware' => 'client_credentials'], function(){
        Route::get('account-admin/index', 'Api\SuperadminApiController@index');
        Route::post('account-admin/store', 'Api\SuperadminApiController@store');
        Route::get('account-admin/edit/{id}', 'Api\SuperadminApiController@superadmin_active_deactive_user');
        Route::get('account-admin/edit_account_admin/{id}','Api\SuperadminApiController@accounts_admin_edit');
        Route::post('account-admin/update_account_admins','Api\SuperadminApiController@accounts_admin_update');
        Route::get('account-admin/get_list_of_orgs', 'Api\SuperadminApiController@get_organization_list');

        
        //AdminApi Route for all
        Route::get('admin/index','Api\AdminApiController@getAdmin')->name('admin');
        Route::get('admin/store','Api\AdminApiController@adminStore')->name('admin.store');
        //ManagerApi route for all function
        //Task Route for all function
        Route::get('admin/index','Api\AdminApiController@getAdmin')->name('admin');
        Route::get('admin/store','Api\AdminApiController@adminStore')->name('admin.store');

        Route::get('organization/index/{slug_id}','Api\OrganisationApiController@getOrganisation')->name('organization.index');
        Route::get('orgs/{findingSlugName}/{authId}/dashboard','Api\OrganisationApiController@getSlugIdOrganisation')->name('slug_id.organization');
        Route::post('organization/store','Api\OrganisationApiController@storeOrganisation')->name('org-store');
        Route::get('organization/edit/{id}/{user_auth_id}','Api\OrganisationApiController@editOrganisation')->name('organization.edit');
        Route::post('organization/update','Api\OrganisationApiController@updateOrganisation')->name('organization.update');
        Route::get('organization/destroy/{id}','Api\OrganisationApiController@destroyOrganisation')->name('organization.delete');

        // Invited role with organization name open
        Route::get('invitedSlugBasedDashbaord/ChekingUserEmail/{getOrgBasedWithRollIdDashboard}','Api\OrganisationApiController@getInvitedUserDasboard'); // email validation from orgainzation
        Route::post('organization/invited','Api\OrganisationApiController@invited_role_with_org_name')->name('invited.role.org.name');
        Route::post('organization/invitedByregister/{get_email_id}/{check_member_email}','Api\OrganisationApiController@invitedByRegsiterUserIDNameStore')->name('inviteByregsiterUser');
        // user invited and removed open
        Route::get('organization/userRemoveOrgDestroy/{id}/{user_organisation_id}','Api\OrganisationApiController@organisationRemoveFromAdmin')->name('organization.remove_org_use');
        Route::get('member_active_deactive_user/{id}','Api\OrganisationApiController@organisationActiveAndDeactive')->name('memberedit');
        // Invited role with organization name close
        
       
        Route::get('invitedManagerUserGetting/{userAuthId}/{organisation_id}','Api\OrganisationApiController@managerGetOnProjectPage');
        //  only manager and user calling in drop down on project close
        //TasktypeApi route for all function
        Route::get('task/index/{id}','Api\TaskApiController@getTask')->name('task.index');
        Route::post('task/store','Api\TaskApiController@storeTask')->name('task.store');
        Route::get('task/edit/{id}','Api\TaskApiController@edit')->name('task.edit');
        Route::post('task/update','Api\TaskApiController@updateTask')->name('task.update');
        Route::get('task/destroy/{id}','Api\TaskApiController@destroyTask')->name('task.delete');

        //ProjectApi Route
        Route::get('project/index/{slug_id}','Api\ProjectApiController@getProject')->name('project.index');
        Route::post('project/store','Api\ProjectApiController@storeProject')->name('project.store');
        Route::get('project/edit/{id}','Api\ProjectApiController@editProject')->name('project.edit');
        Route::post('project/update','Api\ProjectApiController@updateProject')->name('project.update');
        Route::get('project/destroy/{id}','Api\ProjectApiController@destroyProject')->name('project.delete');

        //UsersManager Api Route
        Route::get('usermanager/index/{id}', 'Api\UserManagerController@getUserManager')->name('usermanager');
        Route::post('usermanager/store', 'Api\UserManagerController@UserManagerStore')->name('usersmanager.store');
        Route::get('usermanager/edit_user_manager/{id}', 'Api\UserManagerController@edit')->name('usermanager.edit');
        Route::post('usermanager/update_user_manager', 'Api\UserManagerController@update')->name('usermanager_u_m.update');
        Route::get('usermanagers/destroy_u_m/{id}', 'Api\UserManagerController@destroyUserManager');

        // User Api Route
        Route::get('user/index/{id}','Api\AgentController@getUser')->name('user.index');
        Route::post('user/store','Api\AgentController@store')->name('user.store');
        Route::get('user/edit/{id}','Api\AgentController@edit')->name('user.edit');
        Route::post('user/update','Api\AgentController@update')->name('user.update');
        Route::get('user/destroy/{id}','Api\AgentController@destroy')->name('user.delete');

        // web url api route
        Route::get('addurl/index/{slug_id}','Api\LinkApiController@getUrl')->name('addurl.index');
        Route::post('addurl/store/{project_name}','Api\LinkApiController@storeUrl')->name('addurl.store');
        Route::get('addurl/edit/{id}','Api\LinkApiController@editUrl')->name('addurl.edit');
        Route::post('addurl/update','Api\LinkApiController@updateUrl')->name('add_url.update');
        Route::get('addurl/destroy/{id}','Api\LinkApiController@destroyUrl')->name('addurl.delete');
        Route::get('addurl/getProject/{project_id}','Api\LinkApiController@getProjectid')->name('addurl.getProject');

        //Keyword api route
        Route::get('keyword/index/{id}','Api\KeywordApiController@getKeyword')->name('keyword.index');
        Route::post('keyword/store','Api\KeywordApiController@storeKeyword')->name('keyword.store');
        Route::get('keyword/edit/{id}','Api\KeywordApiController@editKeyword')->name('keyword.edit');
        Route::post('keyword/update','Api\KeywordApiController@updateKeyword')->name('keyword.update');
        Route::get('keyword/destroy/{id}','Api\KeywordApiController@destroyKeyword')->name('destroy');
        Route::get('keyword/getKeywordData/{url_id}','Api\KeywordApiController@getKeywordById')->name('get_Keyword_Data');

        // Teamrating api route
        Route::get('rating/index/{id}','Api\RatingApiController@getRating')->name('rating.index');
        Route::post('rating/store','Api\RatingApiController@storeRating')->name('rating.store');
        Route::get('rating/edit/{id}','Api\RatingApiController@editRating')->name('rating.edit');
        Route::post('rating/update','Api\RatingApiController@updateRating')->name('rating.update');
        Route::get('rating/destroy/{id}','Api\RatingApiController@destroyRating')->name('rating.destroy');
        
        // Pagerank api route
        Route::get('pagerank/index/{id}','Api\PagerankApiController@getPagerank')->name('pagerank.index');
        Route::post('pagerank/store','Api\PagerankApiController@storePagerank')->name('pagerank.store');
        Route::get('pagerank/edit/{id}','Api\PagerankApiController@editPagerank');
        Route::post('pagerank/update','Api\PagerankApiController@updatePagerank');
        Route::get('pagerank/destroy/{id}','Api\PagerankApiController@destroyPagerank');
        
        // Website Ranking api route
        Route::get('webrank/{id}','Api\WebrankApiController@getWebrank')->name('webrank');
        Route::post('webrank/store','Api\WebrankApiController@storeWebrank')->name('webrank.store');
        Route::get('webrank/edit/{id}','Api\WebrankApiController@editWebrank')->name('webrank.edit');
        Route::post('webrank/update','Api\WebrankApiController@updateWebrank')->name('webranks.update');
        Route::get('webrank/destroy/{id}','Api\WebrankApiController@destroyWebrank')->name('webrank.delete');

        // Social Ranking Api route
        Route::get('socialrank/{id}','Api\SocialrankApiController@getSocialrank')->name('socialrank');
        Route::post('socialrank/store','Api\SocialrankApiController@storeSocialrank')->name('socialrank.store');
        Route::get('socialrank/edit/{id}','Api\SocialrankApiController@editSocialrank')->name('socialrank.edit');
        Route::post('socialrank/update','Api\SocialrankApiController@updateSocialrank')->name('socialrank.update');
        Route::get('socialrank/destroy/{id}','Api\SocialrankApiController@destroySocialrank')->name('socialrank.delete');

        //Web Access api route  webaccess
        Route::get('webaccess/{id}','Api\WebAccessApiController@getWebAccess')->name('webaccess');
        Route::post('webaccess/store','Api\WebAccessApiController@storeWebAccess')->name('webaccess.store');
        Route::get('webaccess/edit/{id}','Api\WebAccessApiController@editWebAccess')->name('webaccess.edit');
        Route::post('webaccess/update','Api\WebAccessApiController@updateWebAccess')->name('webaccess.update');
        Route::get('webaccess/destroy/{id}','Api\WebAccessApiController@destroyWebAccess')->name('destroy');
        Route::get('user_vi_token_id/{get_token_id}/{user_getting_id}','Api\WebAccessApiController@getting_token_by_user');
        Route::get('edit_page_validate_vi_token_id/{input_user_token}/{user_prim_id}','Api\WebAccessApiController@getting_on_user_input_token');

        
        //Email api route  webaccess
        Route::get('email/index/{id}','Api\EmailApiController@getemail')->name('email.index');
        Route::post('email/store','Api\EmailApiController@storeEmail')->name('email.store');
        Route::get('email/edit/{id}','Api\EmailApiController@editemail')->name('email.edit');
        Route::post('email/update','Api\EmailApiController@updateemail')->name('email.update');
        Route::get('email/destroy/{id}','Api\EmailApiController@destroyemail')->name('destroy');
        //Phone api route  webaccess
        Route::get('phone/index/{id}','Api\PhoneNumberApiController@getPhoneAccess')->name('phone.index');
        Route::post('phone/store','Api\PhoneNumberApiController@storePhone')->name('phone.store');
        Route::get('phone/edit/{id}','Api\PhoneNumberApiController@editPhone')->name('phone.edit');
        Route::post('phone/update','Api\PhoneNumberApiController@updatephone')->name('phone.update');
        Route::get('phone/destroy/{id}','Api\PhoneNumberApiController@destroyPhone')->name('destroy');

        //TaskBoard api route  webaccess
        Route::get('taskboards/index/{slug_id}','Api\TaskboardApiController@getTaskboard')->name('taskboards.index');
        Route::post('taskboards/store/{project_name}','Api\TaskboardApiController@storeTaskboard')->name('taskboards.store');
        Route::get('taskboards/edit/{id}','Api\TaskboardApiController@editTaskboard')->name('taskboards.edit');
        Route::post('taskboards/update','Api\TaskboardApiController@updateTaskboard')->name('taskboards.update');
        Route::get('taskboards/destroy/{id}','Api\TaskboardApiController@destroyTaskboard')->name('destroy');

        // interval task api routes
        Route::get('interval/{id}/{admin_id}/{task_freq}','Api\IntervalApiController@getInterval')->name('interval');
        Route::post('interval/store','Api\IntervalApiController@storeInterval')->name('interval.store');
        Route::get('interval/edit/{id}','Api\IntervalApiController@editInterval')->name('interval.edit');
        Route::post('interval/update','Api\IntervalApiController@updateInterval')->name('interval.update');
        Route::get('interval/destroy/{id}','Api\IntervalApiController@destroyInterval')->name('interval.delete');

        Route::get('wizard_project/index/{slug_id}','Api\WizardProjectApiController@getWizardProjectValue');
        Route::post('wizard/store_wizards','Api\WizardProjectApiController@storeWizardProject')->name('wizard.project.store');
        Route::get('wizard/edit_wizard/{id}','Api\WizardProjectApiController@edit_wizard_project')->name('wizard.project.edit');
        Route::post('wizard/update_wizard/','Api\WizardProjectApiController@post_wizard_project')->name('wizard.project.post');
        Route::get('wizard/destroy_wizard/{id}','Api\WizardProjectApiController@delete_wizard_project')->name('wizard.project.del');
        Route::get('wizard/getProjectDataId/{project_name_id}','Api\WizardProjectApiController@getProjectById')->name('get_project_Data');

        // Route::get('siteadmin_tasktype/gettasktype/{slug_id}','Api\TaskTypeGetSiteAdminController@getValueAllSiteAdmin')->name('tasktype.siteadmin.index');

        
});

