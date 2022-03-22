<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class WebrankApiController extends Controller
{
    // access token function start
    private function WebrankAccessToken()
    {
        Log::info('In WebrankApiController->WebrankAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_WEBSITE_RANKING_MS_BASE_URL') . Config::get('app.SD_WEBSITE_RANKING_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_WEBSITE_RANKING_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_WEBSITE_RANKING_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_WEBSITE_RANKING_MS_SECRET'),
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
            Log::info('There is some exception in WebrankApiController->WebrankAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get Pagerank function
    public function getWebrank($id)
    {
        try{
            Log::info('SD_WEBSITE_RANKING_MS_ALL_URL: ' . Config::get('app.SD_WEBSITE_RANKING_MS_ALL_URL'));
            $access_token = $this->WebrankAccessToken();
            $url = ''
            .Config::get('app.SD_WEBSITE_RANKING_MS_BASE_URL')
            .Config::get('app.SD_WEBSITE_RANKING_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from WebrankApiController::WebrankAccessToken().Fetching Webrank!');
            Log::info('ALL Webrank URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' =>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' .$access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the Response from WB Keyword MS');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            Log::info('There was some exception in WebrankApiController->getWebrank()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    public function storeWebrank(Request $request)
    {
        Log::info($request);
        Log::info('In WebrankApiController->storeWebrank()');
        $input = $request->all();
        $validator = Validator::make($input, [
            'project_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please fill reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given webrank data...');
            $validatorResponse = $this->validateWebrankData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling WebrankApiController::WebrankAccessToken()');
                $access_token = $this->WebrankAccessToken();
                Log::info('Got the access token from WebrankApiController::WebrankAccessToken(). Now creating Keyword!');

                Log::info('SD_WEBSITE_RANKING_MS_BASE_URL . SD_WEBSITE_RANKING_MS_STORE_URL: ' . Config::get('app.SD_WEBSITE_RANKING_MS_BASE_URL') . Config::get('app.SD_WEBSITE_RANKING_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_WEBSITE_RANKING_MS_BASE_URL') . Config::get('app.SD_WEBSITE_RANKING_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                // Log:info('$http' . $http);
                Log::info('Got the response from create Pagerank ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in WebrankApiController->storeWebrank()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    // validate webrank data
    public function validateWebrankData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            // 'india_rank' => 'required|string|max:255',
            // 'backlinks' => 'required|string|max:255',
            // 'refer' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Webrank already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Webrank data is ready to store'
            ];
        }
    }

    // edit function start
    public function editWebrank(Request $request, $id)
    {
        Log::info('In WebrankApiController->editWebrank()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->WebrankAccessToken();
            $url = ''
                . Config::get('app.SD_WEBSITE_RANKING_MS_BASE_URL')
                . Config::get('app.SD_WEBSITE_RANKING_MS_EDIT')
                .'/'
                .$id;
            Log::info('Got the access token from WebrankApiController::WebrankAccessToken().
            Now fetching Pagerank!');
            Log::info('Webrank Edit Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response');
            $json = json_decode($response->getBody()->getContents(), true);

            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception in WebrankApiController->editWebrank()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update Pagerank function
    public function updateWebrank(Request $request)
    {
        Log::info('In WebrankApiController->updateWebrank()');
        $input = $request->all();
        Log::info('$input[webrank_hidden_id]: ' . $request->webrank_hidden_id);
        Log::info('update krne pe itna value le kr aa rha hai'.$request);
        $validator = Validator::make($input, [
            'usa_rank' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'india_rank' => 'required|string|max:255',
            'backlinks' => 'required|string|max:255',
            'refer' => 'required|string|max:255',
        ]);  
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given keyword data...');

            $validatorResponse = $this->validateWebrankData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling WebrankApiController::WebrankAccessToken()');
                $access_token = $this->WebrankAccessToken();
                Log::info('Got the access token from WebrankApiController::WebrankAccessToken(). Now Updating Keyword!');

                Log::info('SD_WEBSITE_RANKING_MS_BASE_URL . SD_WEBSITE_RANKING_MS_UPDATE: ' . Config::get('app.SD_WEBSITE_RANKING_MS_BASE_URL') . Config::get('app.SD_WEBSITE_RANKING_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_WEBSITE_RANKING_MS_BASE_URL') . Config::get('app.SD_WEBSITE_RANKING_MS_UPDATE'),
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
            Log::info('There was some exception in WebrankApiController->updateWebrank()');
            Log::info('Webrank update nahi ho rha hai');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    //destroy Webrank function
    public function destroyWebrank($id)
    {
        Log::info('In WebrankApiController->destroyWebrank()');
        Log::info('Delete function kaam kr rha hai');
        try {
            $access_token = $this->WebrankAccessToken();
            $url = ''
                . Config::get('app.SD_WEBSITE_RANKING_MS_BASE_URL')
                . Config::get('app.SD_WEBSITE_RANKING_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from WebrankApiController::WebrankAccessToken(). Now fetching pagerank!');
            Log::info('Webrank Delete Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from webrank! aur delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in WebrankApiController->destroyPagerank()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

}
