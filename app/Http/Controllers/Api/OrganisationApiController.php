<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
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
     public function getSlugIdOrganisation($findingSlugName)
     {
        Log::info('continue to dashboard with slug based'.$findingSlugName);
         try {
             Log::info('SD_ORGANISATION_TYPE_MS_DASHBOARD_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_DASHBOARD_URL'));
             $access_token = $this->getOrganisationAccessToken();
             $url = ''
             . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL')
             . Config::get('app.SD_ORGANISATION_TYPE_MS_DASHBOARD_URL')
                 . '/'
                 . $findingSlugName;
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
     public function editOrganisation(Request $request, $id)
     {  
         Log::info('samsag g aa gye hai'.$id);
         log::info('edit page ka value aa rha hai ');
         try {
             $access_token = $this->getOrganisationAccessToken();
             $url = ''
             . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL')
             . Config::get('app.SD_ORGANISATION_TYPE_MS_EDIT')
                 . '/'
                 . $id;
 
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
             

             $validatorResponse = $this->validateNewTaskData($request);
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
         Log::info("delete button me id me kya aa rha hai".$id);
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
         Log::info('In OrganisationApiController->getvalueall()');
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

    // after invited roll base user and organisation open
    
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
            //  Log::info('get user with slug based!'.print_r($json,true));
             Log::info('Number of objects in response: ' . count($json['data']));
             return $json;
         } catch (\Exception $e) {
             Log::info('There was some exception in OrganisationApiController->getInvitedUserDasboard()');
             return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
         }
     }
    // after invited roll base user and organisation close

    // on register time user name and id will be save on OrganisationAPi open
    // public function invitedByRegsiterUserIDNameStore($get_email_id)
    // {
    //     $input = $get_email_id->all();
       
    //     $validator = Validator::make($input, [
    //         // 'u_org_user_email' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         return $response = [
    //             'success' => false,
    //             'message' => 'Please fill Organisation reqiured fields.',
    //         ];
    //     }
    //     try {
    //         Log::info('Validating given Org types data...');
    //         $validatorResponse = $this->validateNewTaskData($request);
    //         if ($validatorResponse['success']) {

    //             Log::info('Calling OrganisationApiController::getOrganisationAccessToken()');
    //             $access_token = $this->getOrganisationAccessToken();
    //             Log::info('Got the access token from OrganisationApiController::getOrganisationAccessToken(). Now creating Task!');

    //             Log::info('SD_ORGANISATION_TYPE_MS_BASE_URL . SD_ORGANISATION_TYPE_MS_INVITED_USER_REGISTER_STORE_URL: ' . Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_INVITED_USER_REGISTER_STORE_URL'));

    //             $http = new Client(); //GuzzleHttp\Client
    //             $response = $http->post(
    //                 Config::get('app.SD_ORGANISATION_TYPE_MS_BASE_URL') . Config::get('app.SD_ORGANISATION_TYPE_MS_INVITED_USER_REGISTER_STORE_URL').'/'. $get_email_id,
    //                 [
    //                     'headers' => [
    //                         'Accept' => 'application/json',
    //                         'Authorization' => 'Bearer ' . $access_token,
    //                     ],
    //                     'form_params' => $request->all(),
    //                 ]
    //             );
               
    //             $responseJson = json_decode($response->getBody()->getContents(), true);
    //             Log::info('resposne main kiya aa raha hai'.print_r($responseJson,true));
    //             // return response()->json($responseJson, 200);
    //             return $responseJson;
    //         } else {
    //             return response()->json($responseJson, 422);
    //         }

    //     } catch (\Exception $e) {
    //         Log::info('something is going to wrong when try to store value');
    //         Log::info($e->getMessage());
    //         $response = [
    //             'success' => false,
    //             'data' => '',
    //             'message' => $e->getMessage(),
    //         ];
    //         return response()->json($response, 500);
    //     }
    // }
    

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
}
