<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class AgentController extends Controller
{
    private static function getUserTypeAccessToken() {
        Log::info('In AgentController->getUserTypeAccessToken()');
        try {
            Log::info('SD_USER_MS_BASE_URL . SD_USER_MS_OAUTH_TOKEN_URL: ' . Config::get('app.SD_USER_MS_BASE_URL') . Config::get('app.SD_USER_MS_OAUTH_TOKEN_URL'));
            Log::info('SD_USER_MS_GRAND_TYPE: ' . Config::get('app.SD_USER_MS_GRAND_TYPE'));
            Log::info('SD_USER_MS_CLIENT_ID: ' . Config::get('app.SD_USER_MS_CLIENT_ID'));
            Log::info('SD_USER_MS_SECRET: ' . Config::get('app.SD_USER_MS_SECRET'));
            Log::info('Getting the token!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_USER_MS_BASE_URL') . Config::get('app.SD_USER_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_USER_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_USER_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_USER_MS_SECRET'),
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
            Log::info('There is some exception in AgentController->getUserTypeAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

     public function getUser($id) {
        Log::info('In AgentController->getUser()');
        try {
            $access_token = $this->getUserTypeAccessToken();
            $url = ''
                . Config::get('app.SD_USER_MS_BASE_URL')
                . Config::get('app.SD_USER_MS_ALL_URL')
                .'/'
                .$id;
            Log::info('Got the access token from AgentController::getUserTypeAccessToken(). Now fetching user!');
            Log::info('User Url: ' . $url);
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
            Log::info('There was some exception in AgentController->getTaskType()');

            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    public function store(Request $request) {
        Log::info($request);
        Log::info('In AgentController->userStore()');
        $input = $request->all();
        $regex = ('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix');
        $validator = Validator::make($input, [
            'name' => 'required|min:3|max:125',
            'email' => 'required|regex:'.$regex,
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {

             // cutome message display open
             $msglist='';
             foreach ($validator->messages()->getMessages() as $field_name => $messages)
                { 
                    $msglist.='<li>'.$messages[0].'</li>'; // messages are retrieved (publicly)
                }
                // cutome message display open  

            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => $msglist
            ];
        }
        try {
            Log::info('Validating given user data...');
            $validatorResponse = $this->validateNewUserData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling AgentController::getUserTypeAccessToken()');
                $access_token = $this->getUserTypeAccessToken();
                Log::info('Got the access token from AgentController::getUserTypeAccessToken(). Now creating Task!');

                Log::info('SD_USER_MS_BASE_URL . SD_USER_MS_STORE_URL: ' . Config::get('app.SD_USER_MS_BASE_URL') . Config::get('app.SD_USER_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_USER_MS_BASE_URL') . Config::get('app.SD_USER_MS_STORE_URL'),
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
            Log::info('There was some exception in AgentController->getUser()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    private function validateNewUserData(Request $request) {

        $input = $request->all();
        Log::info('data validate ho rha hai');
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => 'task type already registered.'
            ];
        } else {
            return $response = [
                'success' => true,
                'message' => 'task type User data is ok to store.'
            ];
        }
    }
    // ###########################  edit page calling ################
    public function edit(Request $request, $id) {
        Log::info('In AgentController->editUser()');
        log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getUserTypeAccessToken();
            $url = ''
                . Config::get('app.SD_USER_MS_BASE_URL')
                . Config::get('app.SD_USER_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from AgentController::getUserTypeAccessToken().
            Now fetching categories!');
            Log::info('Category Url: ' . $url);
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
            Log::info('There was some exception in AgentController->getUser()');
            log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    // update function
    public function update(Request $request) {
        Log::info('In AgentController->update()');
        $input = $request->all();
        $regex = ('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix');
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|regex:'.$regex,
        ]);
        if ($validator->fails()) {

            // cutome message display open
             $msglist='';
             foreach ($validator->messages()->getMessages() as $field_name => $messages)
                { 
                    $msglist.='<li>'.$messages[0].'</li>'; // messages are retrieved (publicly)
                }
                // cutome message display open  

            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => $msglist
            ];
        }
        try {
            Log::info('Validating given user data...');

                $validatorResponse = $this->validateNewUserData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling AgentController::getUserTypeAccessToken()');
                $access_token = $this->getUserTypeAccessToken();
                Log::info('Got the access token from AgentController::getUserTypeAccessToken(). Now creating AgentUser!');

                Log::info('SD_USER_MS_BASE_URL . SD_USER_MS_UPDATE: ' . Config::get('app.SD_USER_MS_BASE_URL') . Config::get('app.SD_USER_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_USER_MS_BASE_URL') . Config::get('app.SD_USER_MS_UPDATE'),
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
            Log::info('There was some exception in AgentController->update()');
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
    public function destroy($id) {
        Log::info('In AgentController->destroyUser()');
        log::info('delete function  kaam kr rha hai');
        try {
            $access_token = $this->getUserTypeAccessToken();
            $url = ''
                . Config::get('app.SD_USER_MS_BASE_URL')
                . Config::get('app.SD_USER_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from AgentController::getUserTypeAccessToken(). Now fetching user!');
            Log::info('User Delete Url: ' . $url);
            Log::info('access_token: ' . $access_token);
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
            // Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (RequestException $e) {
            Log::info('There was some exception delete nahi ho rha hai in AgentController->destroyUser()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    // drop down value open
    public static function getvalueall() {

        Log::info('In AgentController->getvalueall()');
        try {
            Log::info('SD_USER_MS_BASE_URL . SD_USER_MS_ALL_URL: ' . Config::get('app.SD_USER_MS_BASE_URL') . Config::get('app.SD_USER_MS_ALL_URL'));
            Log::info('Calling AgentController->getUserTypeAccessToken()');
            $access_token = AgentController::getUserTypeAccessToken();
            Log::info('Got the access token from AgentController->getUserTypeAccessToken(). Now fetching courses!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_USER_MS_BASE_URL') . Config::get('app.SD_USER_MS_ALL_URL').'/'.Auth::user()->id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from courses!');
            $json = json_decode($response->getBody()->getContents(), true);
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in AgentController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }


// drop down value close

}
