<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class PagerankApiController extends Controller
{
    // access token function start
    private function getPagerankAccessToken()
    {
        Log::info('In PagerankApiController->getPagerankAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_PAGE_RANKING_MS_BASE_URL') . Config::get('app.SD_PAGE_RANKING_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_PAGE_RANKING_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_PAGE_RANKING_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_PAGE_RANKING_MS_SECRET'),
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
            Log::info('There is some exception in PagerankApiController->getPagerankAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get Pagerank function
    public function getPagerank($id)
    {
        try{
            Log::info('SD_PAGE_RANKING_MS_ALL_URL: ' . Config::get('app.SD_PAGE_RANKING_MS_ALL_URL'));
            $access_token = $this->getPagerankAccessToken();
            $url = ''
            .Config::get('app.SD_PAGE_RANKING_MS_BASE_URL')
            .Config::get('app.SD_PAGE_RANKING_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from PagerankApiController::getPagerankAccessToken().Fetching Pagerank!');
            Log::info('ALL Pagerank URL: ' . $url);
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
            Log::info('There was some exception in PagerankApiController->getKeyword()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    public function storePagerank(Request $request)
    {
        Log::info($request);
        Log::info('In PagerankApiController->storePagerank()');
        $input = $request->all();
        $validator = Validator::make($input, [
            'project_name' => 'required',
            'url' => 'required',
            'pagerank' => 'required',
            'authority' => 'required',
            'gsplace' => 'required',
            'bsplace' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please fill reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given pagerank data...');
            $validatorResponse = $this->validatePagerankData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling PagerankApiController::getPagerankAccessToken()');
                $access_token = $this->getPagerankAccessToken();
                Log::info('Got the access token from PagerankApiController::getPagerankAccessToken(). Now creating Keyword!');

                Log::info('SD_PAGE_RANKING_MS_BASE_URL . SD_PAGE_RANKING_MS_STORE_URL: ' . Config::get('app.SD_PAGE_RANKING_MS_BASE_URL') . Config::get('app.SD_PAGE_RANKING_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_PAGE_RANKING_MS_BASE_URL') . Config::get('app.SD_PAGE_RANKING_MS_STORE_URL'),
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
            Log::info('There was some exception in PagerankApiController->storePagerank()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    //validate Pagerank function
    private function validatePagerankData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            // 'project_name' => 'required|string|max:255',
            // 'url' => 'required|string|max:255',
            // 'pagerank' => 'required|string|max:255',
            'authority' => 'required|string|max:255',
            'gsplace' => 'required|string|max:255',
            'bsplace' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Pagerank already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Pagerank data is ready to store'
            ];
        }
    }

    //edit pagerank function
    public function editPagerank(Request $request, $id)
    {
        Log::info(print_r($id, true));
        Log::info('In PagerankApiController->editPagerank()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getPagerankAccessToken();
            $url = ''
                . Config::get('app.SD_PAGE_RANKING_MS_BASE_URL')
                . Config::get('app.SD_PAGE_RANKING_MS_EDIT')
                .'/'
                .$id;
            Log::info('Got the access token from PagerankApiController::getPagerankAccessToken().
            Now fetching Pagerank!');
            Log::info('Pagerank Edit Url: ' . $url);
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
            Log::info('There was some exception in PagerankApiController->editProject()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update Pagerank function
    public function updatePagerank(Request $request)
    {
        Log::info('In PagerankApiController->updatePagerank()');
       
        $input = $request->all();
        Log::info('$input[hidden_id]: ' . $request->hidden_id);
        $validator = Validator::make($input, [
            'pagerank' => 'required|string|max:255',
            'authority' => 'required|string|max:255',
            'gsplace' => 'required|string|max:255',
            'bsplace' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            Log::info('yaha tak value update ka aa rha hai');
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given keyword data...');

            $validatorResponse = $this->validatePagerankData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling PagerankApiController::getPagerankAccessToken()');
                $access_token = $this->getPagerankAccessToken();
                Log::info('Got the access token from PagerankApiController::getPagerankAccessToken(). Now Updating Keyword!');
                Log::info('update ka credential value aa rha hai');
                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_PAGE_RANKING_MS_BASE_URL') . Config::get('app.SD_PAGE_RANKING_MS_UPDATE'),
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
            Log::info('There was some exception in PagerankApiController->updatePagerank()');
            Log::info('Pagerank update nahi ho rha hai');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    //destroy Pagerank function
    public function destroyPagerank($id)
    {
        Log::info('In PagerankApiController->destroyPagerank()');
        Log::info('Delete function kaam kr rha hai');
        try {
            $access_token = $this->getPagerankAccessToken();
            $url = ''
                . Config::get('app.SD_PAGE_RANKING_MS_BASE_URL')
                . Config::get('app.SD_PAGE_RANKING_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from PagerankApiController::getPagerankAccessToken(). Now fetching pagerank!');
            Log::info('Pagerank Delete Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from pagerank! aur delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in PagerankApiController->destroyPagerank()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
