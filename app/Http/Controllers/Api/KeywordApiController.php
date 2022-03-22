<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class KeywordApiController extends Controller
{
    private static function getKeywordAccessToken()
    {
        Log::info('In KeywordApiController->getKeywordAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_KEYWORDS_MS_BASE_URL') . Config::get('app.SD_KEYWORDS_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_KEYWORDS_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_KEYWORDS_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_KEYWORDS_MS_SECRET'),
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
            Log::info('There is some exception in KeywordApiController->getKeywordAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get keyword function
    public function getKeyword($id)
    {
        try{
            Log::info('SD_KEYWORDS_MS_ALL_URL: ' . Config::get('app.SD_KEYWORDS_MS_ALL_URL'));
            $access_token = $this->getKeywordAccessToken();
            $url = ''
            .Config::get('app.SD_KEYWORDS_MS_BASE_URL')
            .Config::get('app.SD_KEYWORDS_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from KeywordApiController::getKeywordAccessToken().Fetching Keyword!');
            Log::info('ALL Keyword URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' =>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' .$access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the Response from WB Keyword MS');
            Log::info('Store hone ke baad index page par value aa raha hai !');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            Log::info('There was some exception in KeywordApiController->getKeyword()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //store project function

    public function storeKeyword(Request $request)
    {
        
        Log::info('In KeywordApiController->storeKeyword()');
        $input = $request->all();
        Log::info('iN keyword controller how many value is comming'.print_r($input,true));
        $validator = Validator::make($input, [
            'project_name' => 'required',
            'url' => 'required',
            'keyword' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please Select reqiured fields.',
            ];
        }
         
        try {
            Log::info('Validating given project data...');
            $validatorResponse = $this->validateKeywordData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling KeywordApiController::getKeywordAccessToken()');
                $access_token = $this->getKeywordAccessToken();

                
                Log::info('Got the access token from KeywordApiController::getKeywordAccessToken(). Now creating Keyword!');

                Log::info('SD_KEYWORDS_MS_BASE_URL . SD_KEYWORDS_MS_STORE_URL: ' . Config::get('app.SD_KEYWORDS_MS_BASE_URL') . Config::get('app.SD_KEYWORDS_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_KEYWORDS_MS_BASE_URL') . Config::get('app.SD_KEYWORDS_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                // Log:info('$http' . $http);
                Log::info('Got the response from create Keyword ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in KeywordApiController->getProject()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    //validate keyword function
    private function validateKeywordData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'project_name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'keyword' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Keyword already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Keyword data is ready to store'
            ];
        }
    }


    //edit keyword function
    public function editKeyword(Request $request, $id)
    {
        Log::info('In KeywordApiController->editKeyword()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getKeywordAccessToken();
            $url = ''
                . Config::get('app.SD_KEYWORDS_MS_BASE_URL')
                . Config::get('app.SD_KEYWORDS_MS_EDIT')
                .'/'
                .$id;
            Log::info('Got the access token from KeywordApiController::getKeywordAccessToken().
            Now fetching keyword!');
            Log::info('Keyword Edit Url: ' . $url);
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
            Log::info('There was some exception in KeywordApiController->editProject()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update keyword function
    public function updateKeyword(Request $request)
    {
        Log::info('In KeywordApiController->updateKeyword()');
        Log::info($request);
        $input = $request->all();
        Log::info('$input[project_name]: ' . $request->project_name);
        Log::info('$input[url]: ' . $request->url);
        Log::info('$input[hidden_id]: ' . $request->hidden_id);
        $validator = Validator::make($input, [
            'project_name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'keyword' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given keyword data...');

            $validatorResponse = $this->validateKeywordData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling KeywordApiController::getKeywordAccessToken()');
                $access_token = $this->getKeywordAccessToken();
                Log::info('Got the access token from KeywordApiController::getKeywordAccessToken(). Now Updating Keyword!');

                Log::info('SD_KEYWORDS_MS_BASE_URL . SD_KEYWORDS_MS_UPDATE: ' . Config::get('app.SD_KEYWORDS_MS_BASE_URL') . Config::get('app.SD_KEYWORDS_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_KEYWORDS_MS_BASE_URL') . Config::get('app.SD_KEYWORDS_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from update keyword!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in KeywordApiController->updateProject()');
            Log::info('Keyword update nahi ho rha hai');
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
    public function destroyKeyword($id)
    {
        Log::info('In KeywordApiController->destroyKeyword()');
        Log::info('Delete function kaam kr rha hai');
        try {
            $access_token = $this->getKeywordAccessToken();
            $url = ''
                . Config::get('app.SD_KEYWORDS_MS_BASE_URL')
                . Config::get('app.SD_KEYWORDS_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from KeywordApiController::getKeywordAccessToken(). Now fetching keywords!');
            Log::info('Keyword Delete Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from Keyword! aur delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            // Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in KeywordApiController->destroyKeyword()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //creating function for getting all values anywhere in ms
    public static function getvalueall() {

        Log::info('In KeywordApiController->getvalueall()');
        try {
            Log::info('SD_KEYWORDS_MS_BASE_URL . SD_KEYWORDS_MS_ALL_URL: ' . Config::get('app.SD_KEYWORDS_MS_BASE_URL') . Config::get('app.SD_KEYWORDS_MS_ALL_URL'));
            Log::info('Calling KeywordApiController->getKeywordAccessToken()');
            $access_token = KeywordApiController::getKeywordAccessToken();
            Log::info('Got the access token from KeywordApiController->getKeywordAccessToken(). Now fetching courses!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_KEYWORDS_MS_BASE_URL') . Config::get('app.SD_KEYWORDS_MS_ALL_URL').'/'.Auth::user()->id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from Keyword!');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in KeywordApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    

     // onchange function via url_id
     public static function getKeywordById(Request $request,$url_id)
     {
         Log::info('in KeywordApiController->getKeywordById()');
         Log::info('keyword ka id ye hai'.'=>'.$url_id);
         try{
             $access_token = KeywordApiController::getKeyWordAccessToken();
             Log::info('Got the access token from KeywordApiController->getKeyWordAccessToken(). Now fetching Keyword!');
             $http = new Client(); //GuzzleHttp\Client
             $response = $http->get(
                 Config::get('app.SD_KEYWORDS_MS_BASE_URL') . Config::get('app.SD_KEYWORDS_MS_GETKEYWORD_URL')
                 .'/'
                 .$url_id,
                 [
                     'headers' => [
                         'Accept'     => 'application/json',
                         'Authorization' => 'Bearer ' . $access_token
                     ]
                 ]
             );
             Log::info('Got the response from Keyword!');
             $json = json_decode($response->getBody()->getContents(), true);
             Log::info('Number of objects in response: ' . count($json['data']));
             return $json['data'];
         } catch(\Exception $e){
             Log::info('keyword ka value nahi aaye ');
             return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
         }
     }

}
