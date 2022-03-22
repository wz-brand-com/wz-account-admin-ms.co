<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class LinkApiController extends Controller
{
    //generating access token as static for getvalueall function
    private static function getAddUrlAccessToken()
    {
        Log::info('In LinkApiController->getAddUrlAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_ADD_URLS_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_ADD_URLS_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_ADD_URLS_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_ADD_URLS_MS_SECRET'),
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
            Log::info('There is some exception in LinkApiController->getAddUrlAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get project function
    public function getUrl($id)
    {
        try{
            Log::info('SD_ADD_URLS_MS_ALL_URL: ' . Config::get('app.SD_ADD_URLS_MS_ALL_URL'));
            $access_token = $this->getAddUrlAccessToken();
            $url = ''
            .Config::get('app.SD_ADD_URLS_MS_BASE_URL')
            .Config::get('app.SD_ADD_URLS_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from LinkApiController::getAddUrlAccessToken(). Now fetching URLs!');
            Log::info('ALL Addurls URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' =>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' .$access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the Response from SD ADDurls MS');
            Log::info('Store hone ke baad index page par value aa raha hai !');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            Log::info('There was some exception in LinkApiController->getProject()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //store project function

    public function storeUrl(Request $request, $project_name)
    {
        Log::info($request);
        Log::info('In LinkApiController->storeUrl()');
        $regex_url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $input = $request->all();
        $validator = Validator::make($input, [
            'url' => 'required|regex:'.$regex_url,
            'project_name' => 'required',
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
                'message' => $msglist,
            ];
        }
        try {
            Log::info('Validating given project data...');
            $validatorResponse = $this->validateUrlData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling LinkApiController::getAddUrlAccessToken()');
                $access_token = $this->getAddUrlAccessToken();
                Log::info('Got the access token from LinkApiController::getAddUrlAccessToken(). Now creating Project!');

                Log::info('SD_ADD_URLS_MS_BASE_URL . SD_ADD_URLS_MS_STORE_URL: ' . Config::get('app.SD_ADD_URLS_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_ADD_URLS_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_STORE_URL')
                    . '/'
                    .$project_name,
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                // Log:info('$http' . $http);
                Log::info('Got the response from create Project ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in LinkApiController->getProject()');
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
    private function validateUrlData(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($input,[
            'url' => 'required',
           
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'URL already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'URL data is ready to store'
            ];
        }
    }


    //edit urls function
    public function editUrl(Request $request, $id)
    {
        Log::info('In LinkApiController->editUrl()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getAddUrlAccessToken();
            $url = ''
                . Config::get('app.SD_ADD_URLS_MS_BASE_URL')
                . Config::get('app.SD_ADD_URLS_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from LinkApiController::getAddUrlAccessToken().
            Now fetching urls!');
            Log::info('Addurls Edit Url: ' . $url);
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
            Log::info('There was some exception in LinkApiController->editProject()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update project function
    public function updateUrl(Request $request)
    {
        Log::info('In LinkApiController->updateUrl()');
        $input = $request->all();
         Log::info('$input[url]: ' .$request);
         Log::info('$input[project_name 5-06-2021]: ' . $request->project_name);
         log::info('$input[addurl_hidden_id]: ' . $request->addurl_hidden_id);
        
        $validator = Validator::make($input, [
            'url' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
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
            Log::info('Validating given project data...');

            $validatorResponse = $this->validateUrlData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling LinkApiController::getAddUrlAccessToken()');
                $access_token = $this->getAddUrlAccessToken();
                Log::info('Got the access token from LinkApiController::getAddUrlAccessToken(). Now Updating Project!');

                Log::info('SD_ADD_URLS_MS_BASE_URL . SD_ADD_URLS_MS_UPDATE: ' . Config::get('app.SD_ADD_URLS_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_ADD_URLS_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in LinkApiController->updateProject()');
            Log::info('project update nahi ho rha hai');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }
    
    //destroy Url function
    public function destroyUrl($id)
    {
        Log::info('In LinkApiController->destroyProject()');
        Log::info('Delete function  kaam kr rha hai');
        try {
            $access_token = $this->getAddUrlAccessToken();
            $url = ''
                . Config::get('app.SD_ADD_URLS_MS_BASE_URL')
                . Config::get('app.SD_ADD_URLS_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from LinkApiController::getAddUrlAccessToken(). Now fetching Urls!');
            Log::info('URL Delete Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from Project! delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in LinkApiController->destroyProject()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //creating function for getting all values anywhere in ms
    public static function getvalueall() {

        Log::info('In LinkApiController->getvalueall()');
        try {
            Log::info('SD_ADD_URLS_MS_BASE_URL . SD_ADD_URLS_MS_ALL_URL: ' . Config::get('app.SD_ADD_URLS_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_ALL_URL'));
            Log::info('Calling LinkApiController->getAddUrlAccessToken()');
            $access_token = LinkApiController::getAddUrlAccessToken();
            Log::info('Got the access token from LinkApiController->getAddUrlAccessToken(). Now fetching urls!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_ADD_URLS_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_ALL_URL').'/'.Auth::user()->id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from URL! SD_ADD_URLS_MS_ALL_URL ' .$response);
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in LinkApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    // onchange function via project_id
public static function getProjectid($project_id)
    {
        Log::info('in LinkApicontroller->getProjectid()'.$project_id);
        try{
            $access_token = LinkApiController::getAddUrlAccessToken();
            Log::info('Got the access token from LinkApiController->getAddUrlAccessToken(). Now fetching urls!');
            $http = new Client(); //GuzzleHttp\Client
            log::info('project id main itna value aa  rha hai'.$project_id);
            $response = $http->get(
                Config::get('app.SD_ADD_URLS_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_GETPROJECT_URL')
                .'/'
                .$project_id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            // return $json['data'];
            return $response;
            
        } catch(\Exception $e){
            Log::info('ye aa gye ham error part me');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
