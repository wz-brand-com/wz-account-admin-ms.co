<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;   
use Config;
use Validator;
use Auth;

class WebAccessApiController extends Controller
{
    private static function getWebAccessToken()
    {
        Log::info('In WebAccessApiController->getWebAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL') . Config::get('app.SD_WEBSITE_ACCESS_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_WEBSITE_ACCESS_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_WEBSITE_ACCESS_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_WEBSITE_ACCESS_MS_SECRET'),
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
            Log::info('There is some exception in WebAccessApiController->getWebAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get WebAccess function 
    public function getWebAccess($id)
    {
        try{
            Log::info('SD_WEBSITE_ACCESS_MS_ALL_URL: ' . Config::get('app.SD_WEBSITE_ACCESS_MS_ALL_URL'));
            $access_token = $this->getWebAccessToken();
            $url = ''
            .Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL')
            .Config::get('app.SD_WEBSITE_ACCESS_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from WebAccessApiController::getWebAccessToken(). Now fetching Web Access Data!');
            Log::info('ALL WebAccess URL: ' . $url);
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
            Log::info('There was some exception in WebAccessApiController->getWebAccess()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //store WebAccess function storeWebAccess

    public function storeWebAccess(Request $request)
    {
       
        $input = $request->all();
        Log::info("request main kiya aa rha hai" . print_r($input,true));
        $regex_email = ('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix');
        $regex_website = ('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/');
        $regex_page_url = ('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/');
        
        $validator = Validator::make($input, [
            'page_url' => 'required|regex:'.$regex_page_url,
            'email_address' => 'required|regex:'.$regex_email,
            'website' => 'required|regex:'.$regex_website,
            'wizard_project_name' => 'required',
            'type_of_task' => 'required',
            'password' => 'required|min:6',
            'user_security_token' => 'required|min:16|max:16'

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
                'email_address' => 'email should be proper way',
            ];
        }
        try {
            Log::info('Validating given Web Access data...');
            $validatorResponse = $this->validateWebAccessData($request);
            if ($validatorResponse['success']) {
                Log::info('Calling WebAccessApiController::getWebAccessToken()');
                $access_token = $this->getWebAccessToken();
                Log::info('Got the access token from WebAccessApiController::getWebAccessToken(). Now creating Web Access!');

                Log::info('SD_WEBSITE_ACCESS_MS_BASE_URL . SD_WEBSITE_ACCESS_MS_STORE_URL: ' . Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL') . Config::get('app.SD_WEBSITE_ACCESS_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL') . Config::get('app.SD_WEBSITE_ACCESS_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                // Log:info('$http' . $http);
                Log::info('Got the response from create Web Access ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in WebAccessApiController->getWebAccess()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    //validate project function
    private function validateWebAccessData(Request $request)
    {
        $input = $request->all();
      
        $validator = Validator::make($input,[
            'type_of_task' => 'required|string|max:255',
            'website' => 'required|string|max:255',
            // 'page_url'   => 'required',
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Web Access already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Web Access is ready to store'
            ];
        }
    }


    //edit Web Access function 
    public function editWebAccess(Request $request, $id)
    {
        Log::info('In WebAccessApiController->editWebAccess()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getWebAccessToken();
            $url = ''
                . Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL')
                . Config::get('app.SD_WEBSITE_ACCESS_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from WebAccessApiController::getWebAccessToken().
            Now fetching Web Access!');
            Log::info('webAcccess Edit : ' . $url);
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
            Log::info('There was some exception in WebAccessApiController->editWebAccess()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update project function 
    public function updateWebAccess(Request $request)
    {
        Log::info('In WebAccessApiController->updateWebAccess()');
        $input = $request->all();
        $regex = ('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/');
        $validator = Validator::make($input, [
            'type_of_task' => 'required|string|max:255',
            'website' => 'required',
            'page_url' => 'required|regex:'.$regex,
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => 'Please fill reqiured fields.',
            ];
        }
        try {  
            Log::info('Validating given Web Access data...');

                $validatorResponse = $this->validateWebAccessData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling WebAccessApiController::getWebAccessToken()');
                $access_token = $this->getWebAccessToken();
                Log::info('Got the access token from WebAccessApiController::getWebAccessToken(). Now Updating Web Access!');

                Log::info('SD_WEBSITE_ACCESS_MS_BASE_URL . SD_WEBSITE_ACCESS_MS_UPDATE: ' . Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL') . Config::get('app.SD_WEBSITE_ACCESS_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL') . Config::get('app.SD_WEBSITE_ACCESS_MS_UPDATE'),
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
            Log::info('There was some exception in WebAccessApiController->updateWebAccess()');
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
    
    //destroy project function
    public function destroyWebAccess($id)
    {
        Log::info('In WebAccessApiController->destroyWebAccess()');
        Log::info('Delete function  kaam kr rha hai');
        try {
            $access_token = $this->getWebAccessToken();
            $url = ''
                . Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL')
                . Config::get('app.SD_WEBSITE_ACCESS_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from WebAccessApiController::getWebAccessToken(). Now fetching Web Access!');
            Log::info('Project Delete Url: ' . $url);
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
            Log::info('There was some exception delete nahi ho rha hai in WebAccessApiController->destroyWebAccess()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //creating function for getting all values anywhere in ms drop down value is comming
    public static function getvalueall() {

        Log::info('In WebAccessApiController->getvalueall()');
        try {
            Log::info('SD_WEBSITE_ACCESS_MS_BASE_URL . SD_WEBSITE_ACCESS_MS_ALL_URL: ' . Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL') . Config::get('app.SD_WEBSITE_ACCESS_MS_ALL_URL'));
            Log::info('Calling WebAccessApiController->getWebAccessToken()');
            $access_token = WebAccessApiController::getWebAccessToken();
            Log::info('Got the access token from WebAccessApiController->getWebAccessToken(). Now fetching Web Access!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL') . Config::get('app.SD_WEBSITE_ACCESS_MS_ALL_URL').'/'.Auth::user()->id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from Web Access!');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in WebAccessApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //====================== on view page decrypt and encrypt open  =========================
    public function getting_token_by_user($get_token_id,$user_getting_id) {

        Log::info("get token id" .$get_token_id);
        Log::info("user getting id" .$user_getting_id);
        Log::info('In WebAccessApiController->editWebAccess()');
        Log::info('we are getting token on view decrypt request ');
        try {
            $access_token = $this->getWebAccessToken();
            Log::info(' token is coming' .$access_token);
            $url = ''
                . Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL')
                . Config::get('app.SD_WEBSITE_ACCESS_MS_DECRYPT_ENCRYPT')
                .'/'
                .$get_token_id.'/'.$user_getting_id;

            Log::info('Got the access token from WebAccessApiController::getWebAccessToken().
            Now fetching Web Access!');
            Log::info('getting_token_by_user : ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            $json = json_decode($response->getBody()->getContents(), true);

            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception in WebAccessApiController->getting_token_by_user()');
            Log::info('value encrypt page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
      
    }
    //====================== on view page decrypt and encrypt close  =========================

        //====================== on edit token will be check open  =========================
        public function getting_on_user_input_token($input_user_token,$user_prim_id) {

            Log::info("get user input token name by request token  " .$input_user_token);
            Log::info("user getting primary id by request" .$user_prim_id);
           
            try {
                $access_token = $this->getWebAccessToken();
                Log::info(' token is coming' .$access_token);
                $url = ''
                    . Config::get('app.SD_WEBSITE_ACCESS_MS_BASE_URL')
                    . Config::get('app.SD_WEBSITE_ACCESS_MS_DECRYPT_ONE_EDIT_PAGE_ENCRYPT')
                    .'/'
                    .$input_user_token.'/'.$user_prim_id;
    
                Log::info('Got the access token from WebAccessApiController::getWebAccessToken().
                Now fetching Web Access!');
                $guzzleClient = new Client(); //GuzzleHttp\Client
                $params = [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ];
                $response = $guzzleClient->request('GET', $url, $params);
                // Log::info('Got the response from token : '.print_r($response,true));
                $json = json_decode($response->getBody()->getContents(), true);
                // Log::info('Got the response 402 line number  from token : '.print_r($json,true));
                return $json;
            } catch (\Exception $e) {
                Log::info('There was some exception in WebAccessApiController->getting_on_user_input_token()');
                Log::info('on edit page token is taking by request');
                return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
            }
          
        }
        //====================== on edit token will be check close  =========================
}
