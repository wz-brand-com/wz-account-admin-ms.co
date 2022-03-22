<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;


class ManagerApiController extends Controller
{
    private static function getManagerAccessToken()
    {
        Log::info('In ManagerApiController-> getManagerAccessToken()');
        try{
            Log::info('SD_MANAGER_MS_BASE_URL:'. Config::get('app.SD_MANAGER_MS_BASE_URL'));
            Log::info('SD_MANAGER_MS_GRAND_TYPE: ' . Config::get('app.SD_MANAGER_MS_GRAND_TYPE'));
            Log::info('SD_MANAGER_MS_CLIENT_ID: ' . Config::get('app.SD_MANAGER_MS_CLIENT_ID'));
            Log::info('SD_MANAGER_MS_SECRET: ' . Config::get('app.SD_MANAGER_MS_SECRET'));
            Log::info('SD_MANAGER_MS_OAUTH_TOKEN_URL: ' . Config::get('app.SD_MANAGER_MS_OAUTH_TOKEN_URL'));
            Log::info('Getting the token!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_MANAGER_MS_BASE_URL') . Config::get('app.SD_MANAGER_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_MANAGER_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_MANAGER_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_MANAGER_MS_SECRET'),
                        'redirect_uri' => '',
                    ],
                ]
            );
            Log::info('response aa gya');
            $array = $response->getBody()->getContents();
            $json = json_decode($array, true);
            $collection = collect($json);
            $access_token = $collection->get('access_token');
            Log::info('Got the token!');
            return $access_token;
        } catch(RequestException $e){
            Log::info('There is some exception in ManagerApiController->getManagerAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    public function getManager($id)
    {
        
        Log::info('In ManagerApiController->getManager()->2nd method calling');
        try{
            Log::info('SD_MANAGER_MS_ALL_URL: ' . Config::get('app.SD_MANAGER_MS_ALL_URL'));
            $access_token = $this->getManagerAccessToken();
            $url = ''
            .Config::get('app.SD_MANAGER_MS_BASE_URL')
            .Config::get('app.SD_MANAGER_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from ManagerApiController::getManagerAccessToken(). Now fetching User!');
            Log::info('ALL URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' =>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' .$access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the Response from SD Manager MS');
            Log::info('Store hone ke baad index page par value aa raha hai !');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            Log::info('There was some exception in ManagerApiController->getManager()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //store superadmin function
    public function managerStore(Request $request) {
        Log::info('In ManagerApiController->managerStore()');
        $input = $request->all();
        $regex = ('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix');
        $validator = Validator::make($input, [
            'name' => 'required|min:3|max:125',
            'email' => 'required|regex:'.$regex,
            'password' => 'required|min:6',
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
                'data' =>  $validator->errors(),
                'message' => $msglist

            ];
        }
        try {
            Log::info('Validating given manager data...');
            $validatorResponse = $this->validateNewManagerData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling ManagerApiController::getManagerAccessToken()');
                $access_token = $this->getManagerAccessToken();
                Log::info('Got the access token from ManagerApiController::getManagerAccessToken(). Now creating Task!');

                Log::info('SD_MANAGER_MS_BASE_URL . SD_MANAGER_MS_STORE_URL: ' . Config::get('app.SD_MANAGER_MS_BASE_URL') . Config::get('app.SD_MANAGER_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_MANAGER_MS_BASE_URL') . Config::get('app.SD_MANAGER_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from create Superadmin ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in ManagerApiController->getManager()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

       
    //Validation for Manager Data
    private function validateNewManagerData(Request $request) {

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $response = [
                'success' => errors,
                'message' => 'Manager already registered.'
            ];
        } else {
            return $response = [
                'success' => true,
                'message' => 'Manager data is ok to store.'
            ];
        }
    }

    //Edit Function for manager
    public function edit(Request $request, $id)
    {
        Log::info('In ManagerApiController->managerEdit()');
        Log::info('Edit Page Ka Form Open hua ab');
        try {
            $access_token = $this->getManagerAccessToken();
            $url = ''
                . Config::get('app.SD_MANAGER_MS_BASE_URL')
                . Config::get('app.SD_MANAGER_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from ManagerApiController::getManagerAccessToken()');
            Log::info('Edit URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from Manager!');
            $json = json_decode($response->getBody()->getContents(), true);
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception in ManagerApiController->managerEdit()');
            log::info('Value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //Update function for ManagerApiController
    public function managerUpdate(Request $request)
    {
        Log::info('In ManagerApiController->managerUpdate()');
        $input = $request->all();
        $regex = ('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix');
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|regex:'.$regex
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
            Log::info('Validating given User data...');

            $validatorResponse = $this->validateUpdateManagerData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling ManagerApiController::getManagerAccessToken()');
                $access_token = $this->getManagerAccessToken();
                Log::info('Got the access token from ManagerApiController::getManagerAccessToken(). Now updating user!');

                Log::info('SD_MANAGER_MS_BASE_URL . SD_MANAGER_MS_UPDATE: ' . Config::get('app.SD_MANAGER_MS_BASE_URL') . Config::get('app.SD_MANAGER_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_MANAGER_MS_BASE_URL') . Config::get('app.SD_MANAGER_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from update New User!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in ManagerApiController->update()');
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

    //Validation for update Manager Data
    private function validateUpdateManagerData(Request $request) {

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => 'Manager already registered.'
            ];
        } else {
            return $response = [
                'success' => true,
                'message' => 'Manager data is ok to store.'
            ];
        }
    }

    //Destroy function start
    public function destroyManager($id) {
        Log::info('In ManagerApiController->destroyManager()');
        log::info('delete function  kaam kr rha hai 24 june');
        try {
            $access_token = $this->getManagerAccessToken();
            $url = ''
                . Config::get('app.SD_MANAGER_MS_BASE_URL')
                . Config::get('app.SD_MANAGER_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from ManagerApiController::getManagerAccessToken(). Now fetching User!');
            Log::info('Category Url: ' . $url);
            Log::info('Category Url access_token: ' . $access_token);
            
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];

            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from data! delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            // Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info(' line 223 main aa gaye There was some exception in ManagerApiController->destroyManager()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //creating function for getting all values anywhere in ms
    public static function getvalueall() {

        Log::info('In ManagerApiController->getvalueall()');
        try {
            Log::info('SD_MANAGER_MS_BASE_URL . SD_MANAGER_MS_ALL_URL: ' . Config::get('app.SD_MANAGER_MS_BASE_URL') . Config::get('app.SD_MANAGER_MS_ALL_URL'));
            Log::info('Calling ManagerApiController->getManagerAccessToken()');
            $access_token = ManagerApiController::getManagerAccessToken();
            Log::info('Got the access token from ManagerApiController->getManagerAccessToken(). Now fetching courses!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_MANAGER_MS_BASE_URL') . Config::get('app.SD_MANAGER_MS_ALL_URL').'/'.Auth::user()->id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from Manager!');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in ManagerApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
