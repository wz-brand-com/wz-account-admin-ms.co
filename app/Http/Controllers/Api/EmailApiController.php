<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class EmailApiController extends Controller
{
    private static function getEmailAccessToken()
    {
        Log::info('In EmailApiController->getEmailAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_EMAIL_MS_BASE_URL') . Config::get('app.SD_EMAIL_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_EMAIL_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_EMAIL_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_EMAIL_MS_SECRET'),
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
        } catch(RequestException $e){
            Log::info('There is some exception in EmailApiController->getEmailAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get Email function 
    public function getemail($id)
    {
        try{
            Log::info('SD_EMAIL_MS_ALL_URL: ' . Config::get('app.SD_EMAIL_MS_ALL_URL'));
            $access_token = $this->getEmailAccessToken();
            $url = ''
            .Config::get('app.SD_EMAIL_MS_BASE_URL')
            .Config::get('app.SD_EMAIL_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from EmailApiController::getEmailAccessToken(). Now fetching Web Access Data!');
            Log::info('ALL Email URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' =>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' .$access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the Response from SD WebAccess MS');
            Log::info('Store hone ke baad index page par value aa raha hai !');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            Log::info('There was some exception in EmailApiController->getemail()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //store WebAccess function storeemail

    public function storeEmail(Request $request)
    
    {
       
        $input = $request->all();
         Log::info("store function target kiya hai " .$request);
        $validator = Validator::make($input, [
            'phone_number' => 'required|string|max:12|min:10',
            'email' => 'required',
            'password' => 'required|string|min:6'
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
                'message' => $msglist,
                'email' => 'email should be proper way',
            ];
        }

        // if ($validator->fails()) {
        //     return $response = [
        //         'success' => false,
        //         'message' => $validator->errors()
        //     ];
        // }
        try {
            Log::info('Validating given Email Access data...');
            $validatorResponse = $this->validateEmailAccessData($request);
            if ($validatorResponse['success']) {

                Log::info('Calling EmailApiController::getEmailAccessToken()');
                $access_token = $this->getEmailAccessToken();
                Log::info('Got the access token from EmailApiController::getEmailAccessToken(). Now creating Eamil Access!');

                Log::info('SD_EMAIL_MS_BASE_URL . SD_EMAIL_MS_STORE_URL: ' . Config::get('app.SD_EMAIL_MS_BASE_URL') . Config::get('app.SD_EMAIL_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_EMAIL_MS_BASE_URL') . Config::get('app.SD_EMAIL_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                // Log:info('$http' . $http);
                Log::info('Got the response from create Email Access ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in EmailApiController->getEmailAccess()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    //validate Email function 
    private function validateEmailAccessData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'email' => 'required',
            'password' => 'required|string|max:255',
            'phone_number' => 'required|max:12|min:10',
            // 'password_hint' => 'required|string|max:255',
            // 'account_recovey_details' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Email already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Email is ready to store'
            ];
        }
    }


    //edit Web Access function 
    public function editemail(Request $request, $id)
    {
        Log::info('In EmailApiController->editemail()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getEmailAccessToken();
            $url = ''
                . Config::get('app.SD_EMAIL_MS_BASE_URL')
                . Config::get('app.SD_EMAIL_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from EmailApiController::getEmailAccessToken().
            Now fetching Web Access!');
            Log::info('Email Edit Url: ' . $url);
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
            Log::info('There was some exception in EmailApiController->editemail()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update Email function 
    public function updateemail(Request $request)
    {
        Log::info('In EmailApiController->updateemail()');
        Log::info($request);
        $input = $request->all();
         Log::info('$input[email]: ' . $request->email);
         Log::info('$input[password]: ' . $request->password);
         log::info('$input[email_hidden_id]: ' . $request->email_hidden_id);
        $validator = Validator::make($input, [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {  
            Log::info('Validating given Email Access data...');

                $validatorResponse = $this->validateEmailAccessData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling EmailApiController::getEmailAccessToken()');
                $access_token = $this->getEmailAccessToken();
                Log::info('Got the access token from EmailApiController::getEmailAccessToken(). Now Updating Web Access!');

                Log::info('SD_EMAIL_MS_BASE_URL . SD_EMAIL_MS_UPDATE: ' . Config::get('app.SD_EMAIL_MS_BASE_URL') . Config::get('app.SD_EMAIL_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_EMAIL_MS_BASE_URL') . Config::get('app.SD_EMAIL_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from create WebAccess!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in EmailApiController->updateemail()');
            Log::info('Web Access update nahi ho rha hai');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }
    
    //destroy Email function
    public function destroyemail($id)
    {
        Log::info('In EmailApiController->destroyemail()');
        Log::info('Delete function  kaam kr rha hai');
        try {
            $access_token = $this->getEmailAccessToken();
            $url = ''
                . Config::get('app.SD_EMAIL_MS_BASE_URL')
                . Config::get('app.SD_EMAIL_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from EmailApiController::getEmailAccessToken(). Now fetching Web Access!');
            Log::info('Email Delete Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from Web Access! delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in EmailApiController->destroyemail()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
