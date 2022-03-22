<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class PhoneNumberApiController extends Controller
{
    private static function getPhoneNummberAccessToken()
    {
        Log::info('In PhoneNumberApiController->getPhoneNummberAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL') . Config::get('app.SD_PHONE_NUMBER_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_PHONE_NUMBER_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_PHONE_NUMBER_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_PHONE_NUMBER_MS_SECRET'),
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
            Log::info('There is some exception in PhoneNumberApiController->getPhoneNummberAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get getPhoneAccess function 
    public function getPhoneAccess($id)
    {
        try{
            Log::info('SD_PHONE_NUMBER_MS_ALL_URL: ' . Config::get('app.SD_PHONE_NUMBER_MS_ALL_URL'));
            $access_token = $this->getPhoneNummberAccessToken();
            $url = ''
            .Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL')
            .Config::get('app.SD_PHONE_NUMBER_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from PhoneNumberApiController::getPhoneNummberAccessToken(). Now fetching Phone Number Data!');
            Log::info('ALL Phone Number URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' =>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' .$access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the Response from Phone NumberMS');
            Log::info('Store hone ke baad index page par value aa raha hai !');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            Log::info('There was some exception in PhoneNumberApiController->getPhoneAccess()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //storePhone WebAccess function storePhone

    public function storePhone(Request $request)
    {
        Log::info($request);
        Log::info('In PhoneNumberApiController->storePhone()');
        $input = $request->all();
         Log::info('$input[phone]: ' . $request->phone);
         Log::info('$input[owner]: ' . $request->owner);
        $validator = Validator::make($input, [
            'phone' => 'required|string|max:12|min:10',
            'owner' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please fill reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given Phone Number data...');
            $validatorResponse = $this->validatePhoneNumberAccessData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling PhoneNumberApiController::getPhoneNummberAccessToken()');
                $access_token = $this->getPhoneNummberAccessToken();
                Log::info('Got the access token from PhoneNumberApiController::getPhoneNummberAccessToken(). Now creating Phone Number!');

                Log::info('SD_PHONE_NUMBER_MS_BASE_URL . SD_PHONE_NUMBER_MS_STORE_URL: ' . Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL') . Config::get('app.SD_PHONE_NUMBER_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL') . Config::get('app.SD_PHONE_NUMBER_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                // Log:info('$http' . $http);
                Log::info('Got the response from create Phone Number ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in PhoneNumberApiController->getPhoneAccess()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    //validate  function 
    private function validatePhoneNumberAccessData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'phone' => 'required|string|max:12|min:10',
            'owner' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Phone Number already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Phone Number is ready to store'
            ];
        }
    }


    //edit Phone Number function editPhone
    public function editPhone(Request $request, $id)
    {
        Log::info('In PhoneNumberApiController->editPhone()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getPhoneNummberAccessToken();
            $url = ''
                . Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL')
                . Config::get('app.SD_PHONE_NUMBER_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from PhoneNumberApiController::getPhoneNummberAccessToken().
            Now fetching Phone Number!');
            Log::info('Phone Number Edit : ' . $url);
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
            Log::info('There was some exception in PhoneNumberApiController->editPhone()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //updatephone project function 
    public function updatephone(Request $request)
    {
        Log::info('In PhoneNumberApiController->updatephone()');
        Log::info($request);
        $input = $request->all();
         Log::info('$input[phone]: ' . $request->phone);
         Log::info('$input[owner]: ' . $request->owner);
         log::info('$input[hidden_id]: ' . $request->hidden_id);
        $validator = Validator::make($input, [
            'phone' => 'required|string|max:12|min:10',
            'owner' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {  
            Log::info('Validating given Phone Number data...');

                $validatorResponse = $this->validatePhoneNumberAccessData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling PhoneNumberApiController::getPhoneNummberAccessToken()');
                $access_token = $this->getPhoneNummberAccessToken();
                Log::info('Got the access token from PhoneNumberApiController::getPhoneNummberAccessToken(). Now Updating Phone Number!');

                Log::info('SD_PHONE_NUMBER_MS_BASE_URL . SD_PHONE_NUMBER_MS_UPDATE: ' . Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL') . Config::get('app.SD_PHONE_NUMBER_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL') . Config::get('app.SD_PHONE_NUMBER_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from create Phone Number!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in PhoneNumberApiController->updatephone()');
            Log::info('Phone Number update nahi ho rha hai');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }
    
    //destroyPhone project function
    public function destroyPhone($id)
    {
        Log::info('In PhoneNumberApiController->destroyPhone()');
        Log::info('Delete function  kaam kr rha hai');
        try {
            $access_token = $this->getPhoneNummberAccessToken();
            $url = ''
                . Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL')
                . Config::get('app.SD_PHONE_NUMBER_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from PhoneNumberApiController::getPhoneNummberAccessToken(). Now fetching Phone Number!');
            Log::info('Phone Number Delete Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from Phone Number! delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in PhoneNumberApiController->destroyPhone()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //creating function for getting all values anywhere in ms drop down value is comming
    public static function getvalueall() {

        Log::info('In PhoneNumberApiController->getvalueall()');
        try {
            Log::info('SD_PHONE_NUMBER_MS_BASE_URL . SD_PHONE_NUMBER_MS_ALL_URL: ' . Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL') . Config::get('app.SD_PHONE_NUMBER_MS_ALL_URL'));
            Log::info('Calling PhoneNumberApiController->getPhoneNummberAccessToken()');
            $access_token = PhoneNumberApiController::getPhoneNummberAccessToken();
            Log::info('Got the access token from PhoneNumberApiController->getPhoneNummberAccessToken(). Now fetching Phone Number!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_PHONE_NUMBER_MS_BASE_URL') . Config::get('app.SD_PHONE_NUMBER_MS_ALL_URL').'/'.Auth::user()->id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from Phone Number!');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in PhoneNumberApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
