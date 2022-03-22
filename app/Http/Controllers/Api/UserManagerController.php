<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class UserManagerController extends Controller
{
    private function getUserManagerAccessToken() {
        Log::info('In UserManagerController->getUserManagerAccessToken()');
        try {
            Log::info('SD_USERS_MANAGER_MS_BASE_URL . SD_USERS_MANAGER_MS_OAUTH_TOKEN_URL: ' . Config::get('app.SD_USERS_MANAGER_MS_BASE_URL') . Config::get('app.SD_USERS_MANAGER_MS_OAUTH_TOKEN_URL'));
            Log::info('SD_USERS_MANAGER_MS_GRAND_TYPE: ' . Config::get('app.SD_USERS_MANAGER_MS_GRAND_TYPE'));
            Log::info('SD_USERS_MANAGER_MS_CLIENT_ID: ' . Config::get('app.SD_USERS_MANAGER_MS_CLIENT_ID'));
            Log::info('SD_USERS_MANAGER_MS_SECRET: ' . Config::get('app.SD_USERS_MANAGER_MS_SECRET'));
            Log::info('Getting the token!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_USERS_MANAGER_MS_BASE_URL') . Config::get('app.SD_USERS_MANAGER_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_USERS_MANAGER_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_USERS_MANAGER_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_USERS_MANAGER_MS_SECRET'),
                        'redirect_uri' => '',
                    ],
                ]
            );
            $array = $response->getBody()->getContents();
            $json = json_decode($array, true);
            $collection = collect($json);
            $access_token = $collection->get('access_token');
            Log::info('Got the token!');
            return $access_token;
        } catch (RequestException $e) {
            Log::info('There is some exception in UserManagerController->getUserManagerAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

     public function getUserManager($id) {
        Log::info('In UserManagerController->getUserManager()');
        try {
            $access_token = $this->getUserManagerAccessToken();
            $url = ''
                . Config::get('app.SD_USERS_MANAGER_MS_BASE_URL')
                . Config::get('app.SD_USERS_MANAGER_MS_ALL_URL')
                .'/'
                .$id;
            Log::info('Got the access token from UserManagerController::getUserManagerAccessToken(). Now fetching categories!');
            Log::info('Category Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from AgentUser');
            log::info(' store hone ke baad index page pe value aa rha hai');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception in UserManagerController->getTaskType()');

            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    public function UserManagerStore(Request $request) {
        Log::info($request);
        Log::info('In UserManagerController->UserManagerStore()');
        $input = $request->all();
         Log::info('$input[user_name]: ' . $request->user_name);
         Log::info('$input[manager_name]: ' . $request->manager_name);
        $validator = Validator::make($input, [
            'user_name' => 'required',
            'manager_name' => 'required',

        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please Select reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given user data...');
            $validatorResponse = $this->validateNewUserManagerData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling UserManagerController::getUserManagerAccessToken()');
                $access_token = $this->getUserManagerAccessToken();
                Log::info('Got the access token from UserManagerController::getUserManagerAccessToken(). Now creating Task!');

                Log::info('SD_USERS_MANAGER_MS_BASE_URL . SD_USERS_MANAGER_MS_STORE_URL: ' . Config::get('app.SD_USERS_MANAGER_MS_BASE_URL') . Config::get('app.SD_USERS_MANAGER_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_USERS_MANAGER_MS_BASE_URL') . Config::get('app.SD_USERS_MANAGER_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from create user');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in UserManagerController->getUserManager()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    private function validateNewUserManagerData(Request $request) {

        $input = $request->all();
        Log::info('data validate ho rha hai');
        $validator = Validator::make($input, [
            'user_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => 'user Manager already registered.'
            ];
        } else {
            return $response = [
                'success' => true,
                'message' => 'user Manager data is ok to store.'
            ];
        }
    }
    // ###########################  edit page calling ################
    public function edit(Request $request, $id) {
        Log::info('In UserManagerController->editUser()');
        log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getUserManagerAccessToken();
            $url = ''
                . Config::get('app.SD_USERS_MANAGER_MS_BASE_URL')
                . Config::get('app.SD_USERS_MANAGER_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from UserManagerController::getUserManagerAccessToken().
            Now fetching categories!');
            Log::info('Edit Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from user');
            $json = json_decode($response->getBody()->getContents(), true);

            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception in UserManagerController->getUserManager()');
            log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    // update function
    public function update(Request $request) {
        Log::info('In UserManagerController->update()');
        Log::info($request);
        $input = $request->all();
         Log::info('$input[user_name]: ' . $request->user_name);
         Log::info('$input[manager_name]: ' . $request->manager_name);
         log::info('$input[u_m_hidden_id]: ' . $request->u_m_hidden_id);
        $validator = Validator::make($input, [
            'user_name' => 'required|string|max:255',
            'manager_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given user data...');

                $validatorResponse = $this->validateNewUserManagerData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling UserManagerController::getUserManagerAccessToken()');
                $access_token = $this->getUserManagerAccessToken();
                Log::info('Got the access token from UserManagerController::getUserManagerAccessToken(). Now creating AgentUser!');

                Log::info('SD_USERS_MANAGER_MS_BASE_URL . SD_USERS_MANAGER_MS_UPDATE: ' . Config::get('app.SD_USERS_MANAGER_MS_BASE_URL') . Config::get('app.SD_USERS_MANAGER_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_USERS_MANAGER_MS_BASE_URL') . Config::get('app.SD_USERS_MANAGER_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from create User!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in UserManagerController->update()');
            Log::info('update nahi ho rha hai');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    // update function close



    public function destroyUserManager($id) {
        Log::info('In UserManagerController->getUserManager()');
        log::info('delete function  kaam kr rha hai');
        try {
            $access_token = $this->getUserManagerAccessToken();
            $url = ''
                . Config::get('app.SD_USERS_MANAGER_MS_BASE_URL')
                . Config::get('app.SD_USERS_MANAGER_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from UserManagerController::getUserManagerAccessToken(). Now fetching categories!');
            Log::info('Category Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from User! delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in UserManagerController->getUserManager()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
