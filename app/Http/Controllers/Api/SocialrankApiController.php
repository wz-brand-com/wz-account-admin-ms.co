<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class SocialrankApiController extends Controller
{
    // access token function start
    private function SocialrankAccessToken()
    {
        Log::info('In SocialrankApiController->SocialrankAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_SOCIAL_RANKING_MS_BASE_URL') . Config::get('app.SD_SOCIAL_RANKING_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_SOCIAL_RANKING_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_SOCIAL_RANKING_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_SOCIAL_RANKING_MS_SECRET'),
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
            Log::info('There is some exception in SocialrankApiController->SocialrankAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get Pagerank function
    public function getSocialrank($id)
    {
        Log::info('In SocialrankApiController->getSocialrank()');
        try{
            Log::info('SD_SOCIAL_RANKING_MS_ALL_URL: ' . Config::get('app.SD_SOCIAL_RANKING_MS_ALL_URL'));
            $access_token = $this->SocialrankAccessToken();
            $url = ''
            .Config::get('app.SD_SOCIAL_RANKING_MS_BASE_URL')
            .Config::get('app.SD_SOCIAL_RANKING_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from SocialrankApiController::SocialrankAccessToken().Fetching Webrank!');
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
            Log::info('There was some exception in SocialrankApiController->getSocialrank()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    public function storeSocialrank(Request $request)
    {
        Log::info($request);
        Log::info('In SocialrankApiController->storeSocialrank()');
        $input = $request->all();
        $validator = Validator::make($input, [
            'project_name' => 'required',
            'project_id' => 'required',
            'fb_likes' => 'required',
            'yt_subs' => 'required',
            'tw_follower' => 'required',
            'insta_follower' => 'required'
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please fill reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given Socialrank data...');
            $validatorResponse = $this->validateSocialrankData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling SocialrankApiController::SocialrankAccessToken()');
                $access_token = $this->SocialrankAccessToken();
                Log::info('Got the access token from SocialrankApiController::SocialrankAccessToken(). Now creating Keyword!');

                Log::info('SD_SOCIAL_RANKING_MS_BASE_URL . SD_SOCIAL_RANKING_MS_STORE_URL: ' . Config::get('app.SD_SOCIAL_RANKING_MS_BASE_URL') . Config::get('app.SD_SOCIAL_RANKING_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_SOCIAL_RANKING_MS_BASE_URL') . Config::get('app.SD_SOCIAL_RANKING_MS_STORE_URL'),
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
            Log::info('There was some exception in SocialrankApiController->storeSocialrank()');
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
    public function validateSocialrankData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'tw_follower' => 'required|string|max:255',
            'insta_follower' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Socialrank already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Socialrank data is ready to store'
            ];
        }
    }

    // edit function start
    public function editSocialrank(Request $request, $id)
    {
        Log::info('In SocialrankApiController->editSocialrank()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->SocialrankAccessToken();
            $url = ''
                . Config::get('app.SD_SOCIAL_RANKING_MS_BASE_URL')
                . Config::get('app.SD_SOCIAL_RANKING_MS_EDIT')
                .'/'
                .$id;
            Log::info('Got the access token from SocialrankApiController::SocialrankAccessToken().
            Now fetching Pagerank!');
            Log::info('Socialrank Edit Url: ' . $url);
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
            Log::info('There was some exception in SocialrankApiController->editSocialrank()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //update Pagerank function
    public function updateSocialrank(Request $request)
    {
        Log::info('In SocialrankApiController->updateSocialrank()');
        $input = $request->all();
        Log::info(print_r($input,true));
        $validator = Validator::make($input, [
            // 'project_name' => 'required|string|max:255',
            'tw_follower' => 'required|string|max:255',
            'insta_follower' => 'required|string|max:255',   
        ]);  
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given keyword data...');

            $validatorResponse = $this->validateSocialrankData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling SocialrankApiController::SocialrankAccessToken()');
                $access_token = $this->SocialrankAccessToken();
                Log::info('Got the access token from SocialrankApiController::SocialrankAccessToken(). Now Updating Social rank!');

                Log::info('SD_SOCIAL_RANKING_MS_BASE_URL . SD_SOCIAL_RANKING_MS_UPDATE: ' . Config::get('app.SD_SOCIAL_RANKING_MS_BASE_URL') . Config::get('app.SD_SOCIAL_RANKING_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_SOCIAL_RANKING_MS_BASE_URL') . Config::get('app.SD_SOCIAL_RANKING_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from update Social Rank!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in SocialrankApiController->updateSocialrank()');
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

    //destroySocialrank function
    public function destroySocialrank($id)
    {
        Log::info('In SocialrankApiController->destroySocialrank()');
        Log::info('Delete function kaam kr rha hai');
        try {
            $access_token = $this->SocialrankAccessToken();
            $url = ''
                . Config::get('app.SD_SOCIAL_RANKING_MS_BASE_URL')
                . Config::get('app.SD_SOCIAL_RANKING_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from SocialrankApiController::SocialrankAccessToken(). Now fetching pagerank!');
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
            Log::info('There was some exception delete nahi ho rha hai in SocialrankApiController->destroyPagerank()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
