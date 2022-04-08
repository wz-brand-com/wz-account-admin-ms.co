<?php

namespace App\Http\Controllers\Api;

use Auth;
use Config;
use Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ManagerController;

class OrganisationApiController extends Controller
{
     //Generating AccessToken
     private static function getOrganisationAccessToken() 
     {
         Log::info('In OrganisationApiController-> getOrganisationAccessToken()');
         try {
             Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL:' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL'));
             Log::info('SD_ORGANISATION_TYPE_MS_OAUTH_TOKEN_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_OAUTH_TOKEN_URL'));

             Log::info('SD_ORGANISATION_TYPE_MS_GRAND_TYPE: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_GRAND_TYPE'));
             Log::info('SD_ORGANISATION_TYPE_MS_CLIENT_ID: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_CLIENT_ID'));
             Log::info('SD_ORGANISATION_TYPE_MS_SECRET: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_SECRET'));
             Log::info('Getting the token!');
             $http = new Client(); //GuzzleHttp\Client
             $response = $http->post(
                 Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_OAUTH_TOKEN_URL'),
                 [
                     'form_params' => [
                         'grant_type' => Config::get('app.SD_ORGANISATION_TYPE_MS_GRAND_TYPE'),
                         'client_id' => Config::get('app.SD_ORGANISATION_TYPE_MS_CLIENT_ID'),
                         'client_secret' => Config::get('app.SD_ORGANISATION_TYPE_MS_SECRET'),
                         'redirect_uri' => '',
                     ],
                 ]
             );
             Log::info('response aa gya');
             $array = $response->getBody()->getContents();
             $json = json_decode($array, true);
             $collection = collect($json);
             $access_token = $collection->get('access_token');
             Log::info('this api is Got the token!'.$access_token);
             return $access_token;
         } catch (RequestException $e) {
             Log::info('There is some exception in OrganisationApiController->getOrganisationAccessToken()');
             return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
         }
     }
 
     public function getOrganisation($slug_id)
     {
 
         Log::info('In OrganisationApiController function getOrganisation');
         try {
             Log::info('SD_ORGANISATION_TYPE_MS_ALL_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_ALL_URL'));
             $access_token = $this->getOrganisationAccessToken();
             $url = ''
             . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL')
             . Config::get('app.SD_ORGANISATION_TYPE_MS_ALL_URL')
                 . '/'
                 . $slug_id;
             Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now fetching User!');
             Log::info('ALL URL: ' . $url);
             $guzzleClient = new Client(); //GuzzleHttp\Client
             $params = [
                 'headers' => [
                     'Accept' => 'application/json',
                     'Authorization' => 'Bearer ' . $access_token,
                 ],
             ];
             $response = $guzzleClient->request('GET', $url, $params);
             Log::info('Got the Response from SD Tasktype MS');
             Log::info('Store hone ke baad index page par value aa raha hai !');
             $json = json_decode($response->getBody()->getContents(), true);
             Log::info('Number of objects in response: ' . count($json['data']));
             return $json;
         } catch (\Exception $e) {
             Log::info('There was some exception in OrganisationApiController->getTask()');
             return $e->getResponse()->getStatusCode() . ':' . $e->getMessage();
         }
     }
     public function getSlugIdOrganisation($findingSlugName,$authId)
     {
        Log::info('continue to dashboard with slug based'.$findingSlugName);
        Log::info('user auth id getting'.$authId);
         try {
             Log::info('SD_ORGANISATION_TYPE_MS_DASHBOARD_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_DASHBOARD_URL'));
             $access_token = $this->getOrganisationAccessToken();
             $url = ''
             . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL')
             . Config::get('app.SD_ORGANISATION_TYPE_MS_DASHBOARD_URL')
                 . '/'
                 . $findingSlugName.'/'.$authId;
             Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now fetching User!');
             Log::info('ALL URL: ' . $url);
             $guzzleClient = new Client(); //GuzzleHttp\Client
             $params = [
                 'headers' => [
                     'Accept' => 'application/json',
                     'Authorization' => 'Bearer ' . $access_token,
                 ],
             ];
             $response = $guzzleClient->request('GET', $url, $params);
             Log::info('Got the Response from SD Tasktype MS');
             Log::info('Store hone ke baad index page par value aa raha hai !');
             $json = json_decode($response->getBody()->getContents(), true);
             return $json;
         } catch (\Exception $e) {
             Log::info('not getting value for display on dashboard');
             return $e->getResponse()->getStatusCode() . ':' . $e->getMessage();
         }
     }
 
     public function storeOrganisation(Request $request)
     {
        
         $input = $request->all();
         Log::info('In OrganisationApiController->storeOrganisation()'.print_r($input,true));
         $validator = Validator::make($input, [
             'org_name' => 'required',
         ]);
         if ($validator->fails()) {
             return $response = [
                 'success' => false,
                 'message' => 'Please fill Organisation reqiured fields.',
             ];
         }
         try {
             Log::info('Validating given Org types data...');
             $validatorResponse = $this->validateNewTaskData($request);
             if ($validatorResponse['success']) {
 
                 Log::info('Calling OrganisationApiController::getOrganisationAccessToken()');
                 $access_token = $this->getOrganisationAccessToken();
                 Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now creating Task!');
 
                 Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL . SD_ORGANISATION_TYPE_MS_STORE_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_STORE_URL'));
 
                 $http = new Client(); //GuzzleHttp\Client
                 $response = $http->post(
                     Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_STORE_URL'),
                     [
                         'headers' => [
                             'Accept' => 'application/json',
                             'Authorization' => 'Bearer ' . $access_token,
                         ],
                         'form_params' => $request->all(),
                     ]
                 );
                 // Log:info('$http' . $http);
                 Log::info('Got the response from create Org types ');
                 Log::info('data store ho gaya hai successfully');
                 $responseJson = json_decode($response->getBody()->getContents(), true);
 
                 return response()->json($responseJson, 200);
             } else {
                 return response()->json($responseJson, 422);
             }
 
         } catch (\Exception $e) {
             Log::info('There was some exception in OrganisationApiController->Org types()');
             Log::info($e->getMessage());
             $response = [
                 'success' => false,
                 'data' => '',
                 'message' => $e->getMessage(),
             ];
             return response()->json($response, 500);
         }
     }
 
     //function for validating new Org types
     private function validateNewTaskData(Request $request)
     {
 
         $input = $request->all();
         $validator = Validator::make($input, [
            //  'org_name' => 'required|string|max:255',
         ]);
         if ($validator->fails()) {
             return $response = [
                 'success' => false,
                 'message' => 'Org types already registered.',
             ];
         } else {
             return $response = [
                 'success' => true,
                 'message' => 'Org  data is ok to store.',
             ];
         }
     }
 
     // edit function start
     public function editOrganisation(Request $request, $id,$user_auth_id)
     {
         Log::info('In OrganisationApiController->editOrganisation()');
         log::info('edit page ka value aa rha hai ');
         try {
             $access_token = $this->getOrganisationAccessToken();
             $url = ''
             . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL')
             . Config::get('app.SD_ORGANISATION_TYPE_MS_EDIT')
                 . '/'
                 . $id.'/'.$user_auth_id;
 
             Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken().
             Now fetching categories!');
             Log::info('Task Edit Url: ' . $url);
             $guzzleClient = new Client(); //GuzzleHttp\Client
             $params = [
                 'headers' => [
                     'Accept' => 'application/json',
                     'Authorization' => 'Bearer ' . $access_token,
                 ],
             ];
             $response = $guzzleClient->request('GET', $url, $params);
             Log::info('Got the response from task!');
             $json = json_decode($response->getBody()->getContents(), true);
 
             return $json;
         } catch (\Exception $e) {
             Log::info('There was some exception in OrganisationApiController->Org types()');
             log::info('value edit page pe nahi aa raha hai');
             return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
         }
     }
     // update function start
     public function updateOrganisation(Request $request)
     {
         Log::info('In OrganisationApiController->update()');
         $input = $request->all();
         Log::info('$input[org_name]: ' . $request->org_name);
      
         $validator = Validator::make($input, [
             'org_name' => 'required|string|max:255',
 
         ]);
         if ($validator->fails()) {
             return $response = [
                 'success' => false,
                 'message' => $validator->errors(),
             ];
         }
         try {
             Log::info('Validating given Org types data...');
 
             $validatorResponse = $this->validateNewTaskData($request);
 
             Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
             Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
             if ($validatorResponse['success']) {
 
                 Log::info('Calling OrganisationApiController::getOrganisationAccessToken()');
                 $access_token = $this->getOrganisationAccessToken();
                 Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now creating task!');
 
                 Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL . SD_ORGANISATION_TYPE_MS_UPDATE: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') .
                     Config::get('app.SD_ORGANISATION_TYPE_MS_STORE_URL'));
 
                 $http = new Client(); //GuzzleHttp\Client
                 $response = $http->post(
                     Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_UPDATE'),
                     [
                         'headers' => [
                             'Accept' => 'application/json',
                             'Authorization' => 'Bearer ' . $access_token,
                         ],
                         'form_params' => $request->all(),
                     ]
                 );
                 Log::info('Got the response from create Org types!');
                 $responseJson = json_decode($response->getBody()->getContents(), true);
 
                 return response()->json($responseJson, 200);
             } else {
                 return response()->json($responseJson, 422);
             }
 
         } catch (\Exception $e) {
             Log::info('There was some exception in OrganisationApiController->update()');
             Log::info('update nahi ho rha hai');
             Log::info($e->getMessage());
             $response = [
                 'success' => false,
                 'data' => '',
                 'message' => $e->getMessage(),
             ];
 
             return response()->json($response, 500);
         }
     }
 
     // update function close
 
     public function destroyOrganisation($id)
     {
         Log::info('In OrganisationApiController->destroyOrganisation()');
         Log::info('delete function kaam kr rha hai in account admin page');
         try {
             $access_token = $this->getOrganisationAccessToken();
             $url = ''
             . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL')
             . Config::get('app.SD_ORGANISATION_TYPE_MS_DELETE_URL')
                 . '/'
                 . $id;
             Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now fetching categories!');
             Log::info('Org types Delete Url: ' . $url);
             $guzzleClient = new Client(); //GuzzleHttp\Client
             $params = [
                 'headers' => [
                     'Accept' => 'application/json',
                     'Authorization' => 'Bearer ' . $access_token,
                 ],
             ];
 
             $response = $guzzleClient->request('GET', $url, $params);
             Log::info('Got the response from data! delete ho gaya successfully..');
             $json = json_decode($response->getBody()->getContents(), true);
             // Log::info('Number of objects in response: ' . count($json['data']));
             return $json;
         } catch (\Exception $e) {
             Log::info('There was some exception delete nahi ho rha hai in OrganisationApiController->Org types()');
             return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
         }
     }
 
     public static function getvalueall($slug_id)
     {
         Log::info('In this function getvalueall()'.print_r($slug_id,true));
         try {
             Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL . SD_ORGANISATION_TYPE_MS_ALL_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_ALL_URL'));
             Log::info('Calling OrganisationApiController->getOrganisationAccessToken()');
             $access_token = OrganisationApiController::getOrganisationAccessToken();
             Log::info('Got the access token from OrganisationApiController->getOrganisationAccessToken(). Now fetching Org types!');
             $http = new Client(); //GuzzleHttp\Client
             $response = $http->get(
                 Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_ALL_URL') . '/' .$slug_id,
                 [
                     'headers' => [
                         'Accept' => 'application/json',
                         'Authorization' => 'Bearer ' . $access_token,
                     ],
                 ]
             );
 
             Log::info('Got the response from Org types!');
             $json = json_decode($response->getBody()->getContents(), true);
             Log::info('Number of objects in response: ' . count($json['data']));
             return $json['data'];
         } catch (\Exception $e) {
             Log::info('There was some exception in OrganisationApiController->getvalueall()');
             return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
         }
     }


    //  invite organisation role and slug name open
    public function invited_role_with_org_name(Request $request)
    {
        $input = $request->all();
        Log::info('On invite organisation role and slug name from admin page'.print_r($input,true));
        $validator = Validator::make($input, [
            'u_org_user_email' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => 'Please fill Organisation reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given Org types data...');
            $validatorResponse = $this->validateNewTaskData($request);
            if ($validatorResponse['success']) {

                Log::info('Calling OrganisationApiController::getOrganisationAccessToken()');
                $access_token = $this->getOrganisationAccessToken();
                Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now creating Task!');

                Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL . SD_ORGANISATION_TYPE_MS_STORE_ROLE_ORG_NAME_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_STORE_ROLE_ORG_NAME_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_STORE_ROLE_ORG_NAME_URL'),
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token,
                        ],
                        'form_params' => $request->all(),
                    ]
                );
               
                $responseJson = json_decode($response->getBody()->getContents(), true);
                Log::info('resposne main kiya aa raha hai'.print_r($responseJson,true));
                // return response()->json($responseJson, 200);
                return $responseJson;
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in OrganisationApiController->Org types()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '',
                'message' => $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }
    //  invite organisation role and slug name close

   // After invited member then member will be display with slug based open
    
    public static function getInvitedUserDasboard($getOrgBasedWithRollIdDashboard)
     {
         
         try {
             Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL . SD_ORGANISATION_TYPE_MS_AFTER_INVITE_GET_USER_ALL_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_AFTER_INVITE_GET_USER_ALL_URL'));
             Log::info('Calling OrganisationApiController->getOrganisationAccessToken()');
             $access_token = OrganisationApiController::getOrganisationAccessToken();
             Log::info('Got the access token from OrganisationApiController->getOrganisationAccessToken(). Now fetching Org types!');
             $http = new Client(); //GuzzleHttp\Client
             $response = $http->get(
                 Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_AFTER_INVITE_GET_USER_ALL_URL') . '/' .$getOrgBasedWithRollIdDashboard,
                 [
                     'headers' => [
                         'Accept' => 'application/json',
                         'Authorization' => 'Bearer ' . $access_token,
                     ],
                 ]
             );
 
             Log::info('Got the response from Org types!');
             $json = json_decode($response->getBody()->getContents(), true);
             Log::info('Number of objects in response: ' . count($json['data']));
             return $json;
         } catch (\Exception $e) {
             Log::info('There was some exception in OrganisationApiController->getInvitedUserDasboard()');
             return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
         }
     }
    // After invited member then member will be display with slug based  close

    
    

    public function invitedByRegsiterUserIDNameStore($get_email_id,$check_member_email)
    {
        
        try {
            Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL . SD_ORGANISATION_TYPE_MS_INVITED_USER_REGISTER_STORE_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_INVITED_USER_REGISTER_STORE_URL'));
            Log::info('Calling OrganisationApiController->getOrganisationAccessToken()');
            $access_token = OrganisationApiController::getOrganisationAccessToken();
            Log::info('Got the access token from OrganisationApiController->getOrganisationAccessToken(). Now fetching Org types!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_INVITED_USER_REGISTER_STORE_URL') . '/' .$get_email_id.'/'.$check_member_email,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token,
                    ],
                ]
            );

            Log::info('Got the response from Org types!');
            // $json = json_decode($response->getBody()->getContents(), true);
            $responseJson = json_decode($response->getBody()->getContents(), true);
           //  Log::info('get user with slug based!'.print_r($json,true));
            // Log::info('Number of objects in response: ' . count($json['data']));
            // return $json;
            return response()->json($responseJson, 200);
        } catch (\Exception $e) {
            Log::info('something is going to wrong when try to store value');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    // on register time user name and id will be save on OrganisationAPi close


     // ################################## remove organisation with user after invited open #############################

    public function organisationRemoveFromAdmin($id,$user_organisation_id)
    {
        Log::info('In OrganisationApiController->organisationRemoveFromAdmin()');
        Log::info('organisationRemoveFromAdmin function kaam kr rha hai in account admin page');
        try {
            $access_token = $this->getOrganisationAccessToken();
            $url = ''
            . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL')
            . Config::get('app.SD_ORGANISATION_TYPE_MS_ORGANISATION_REMOVE_FROM_ADMIN_TO_USER_URL')
                . '/'
                . $id.'/'.$user_organisation_id;
            Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now fetching categories!');
            Log::info('Org types organisation remove ho gaya Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token,
                ],
            ];

            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from data! organisation remove ho gaya ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            // Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception organisation block ho gaya nahi ho rha hai in OrganisationApiController->Org types()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    // ################################## remove organisation with user after invited close ############################


    
    // organisation with block open
    public function organisationActiveAndDeactive($id)
    {
        Log::info('block pe clik ho gaya hai now we get'.$id);
        Log::info('organisationActiveAndDeactive function kaam kr rha hai in account admin page');
        try {
            $access_token = $this->getOrganisationAccessToken();
            $url = ''
            . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL')
            . Config::get('app.SD_ORGANISATION_TYPE_MS_ORGANISATION_BLOCK_AND_ACTIVE_URL')
                . '/'
                . $id;
            Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now fetching categories!');
            Log::info('Org types organisation remove ho gaya Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token,
                ],
            ];

            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from data! organisation block ho gaya ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            // Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception organisation block ho gaya nahi ho rha hai in OrganisationApiController->Org types()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    // organisation with block close

    // manager will be display on project page open
    public static function managerGetOnProjectPage($userAuthId,$organisation_id)
     {
         Log::info('In this function managerGetOnProjectPage  user auth id'.$userAuthId);
         Log::info('In this function managerGetOnProjectPage organisation id '.$organisation_id);
         try {
             Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL . SD_ORGANISATION_TYPE_MS_MANAGER_GETTING_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_MANAGER_GETTING_URL'));
             Log::info('Calling OrganisationApiController->getOrganisationAccessToken()');
             $access_token = OrganisationApiController::getOrganisationAccessToken();
             Log::info('Got the access token from OrganisationApiController->getOrganisationAccessToken(). Now fetching Org types!');
             $http = new Client(); //GuzzleHttp\Client
             $response = $http->get(
                 Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_MANAGER_GETTING_URL') . '/' .$userAuthId.'/'.$organisation_id,
                 [
                     'headers' => [
                         'Accept' => 'application/json',
                         'Authorization' => 'Bearer ' . $access_token,
                     ],
                 ]
             );
 
             
             $json = json_decode($response->getBody()->getContents(), true);
             Log::info('Number of objects in response: ' . count($json['data']));
             Log::info('how many manager is calling in project field'.print_r($json,true));
             return $json['data'];
         } catch (\Exception $e) {
             Log::info('There was some exception in OrganisationApiController->getvalueall()');
             return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
         }
     }
    // manager will be display on project page close


       
}
