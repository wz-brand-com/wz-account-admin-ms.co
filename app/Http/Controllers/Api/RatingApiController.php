<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class RatingApiController extends Controller
{
    private static function getRatingAccessToken()
    {
        Log::info('In RatingApiController->getRatingAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_TEAM_RATING_MS_BASE_URL') . Config::get('app.SD_TEAM_RATING_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_TEAM_RATING_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_TEAM_RATING_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_TEAM_RATING_MS_SECRET'),
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
            Log::info('There is some exception in RatingApiController->getRatingAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get Rating function
    public function getRating($id)
    {
        try{
            Log::info('SD_TEAM_RATING_MS_ALL_URL: ' . Config::get('app.SD_TEAM_RATING_MS_ALL_URL'));
            $access_token = $this->getRatingAccessToken();
            $url = ''
            .Config::get('app.SD_TEAM_RATING_MS_BASE_URL')
            .Config::get('app.SD_TEAM_RATING_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from RatingApiController::getRatingAccessToken(). Now fetching User!');
            Log::info('Get Rating  URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' =>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' .$access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the Response from SD Project MS');
            Log::info('Store hone ke baad index page par value aa raha hai !');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            // Log::info('There was some exception in RatingApiController->getProject()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //store rating function

    public function storeRating(Request $request)
    {
        Log::info($request);
        Log::info('In RatingApiController->storeRating()');
        $input = $request->all();
        $validator = Validator::make($input, [
            'rating_user_name' => 'required',
            'rating_manager_name' => 'required',
            'week' =>'required',
            'month' => 'required',
            'year' =>'required',
            'rating' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please Select reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given rating data...');
            $validatorResponse = $this->validateRatingData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling RatingApiController::getRatingAccessToken()');
                $access_token = $this->getRatingAccessToken();
                Log::info('Got the access token from RatingApiController::getRatingAccessToken(). Now creating Project!');

                Log::info('SD_TEAM_RATING_MS_BASE_URL . SD_TEAM_RATING_MS_STORE_URL: ' . Config::get('app.SD_TEAM_RATING_MS_BASE_URL') . Config::get('app.SD_TEAM_RATING_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_TEAM_RATING_MS_BASE_URL') . Config::get('app.SD_TEAM_RATING_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response from create Rating');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in RatingApiController->storeRating()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    //validate Rating function
    private function validateRatingData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'rating_user_name' => 'required|string|max:255',
            'rating_manager_name' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Rating already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Rating data is ready to store'
            ];
        }
    }

    //edit Rating function
    public function editRating(Request $request, $id)
    {
        Log::info('In RatingApiController->editRating()');
        try {
            $access_token = $this->getRatingAccessToken();
            $url = ''
                . Config::get('app.SD_TEAM_RATING_MS_BASE_URL')
                . Config::get('app.SD_TEAM_RATING_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from RatingApiController::getRatingAccessToken().
            Now fetching rating!');
            Log::info('Rating Edit Url: ' . $url);
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
            Log::info('There was some exception in RatingApiController->editRating()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //update project function
    public function updateRating(Request $request)
    {
        Log::info('In RatingApiController->updateRating()');
        Log::info($request);
        $input = $request->all();
        Log::info('$input[rating_user_name]: ' . $request->rating_user_name);
        $validator = Validator::make($input, [
            'rating_user_name' => 'required|string|max:255',
            'rating_manager_name' => 'required|string|max:255',
            'week' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given project data...');

                $validatorResponse = $this->validateRatingData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling RatingApiController::getRatingAccessToken()');
                $access_token = $this->getRatingAccessToken();
                Log::info('Got the access token from RatingApiController::getRatingAccessToken(). Now Updating Project!');

                Log::info('SD_TEAM_RATING_MS_BASE_URL . SD_TEAM_RATING_MS_UPDATE: ' . Config::get('app.SD_TEAM_RATING_MS_BASE_URL') . Config::get('app.SD_TEAM_RATING_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_TEAM_RATING_MS_BASE_URL') . Config::get('app.SD_TEAM_RATING_MS_UPDATE'),
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
            Log::info('There was some exception in RatingApiController->updateRating()');
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
    
    //destroy Rating function
    public function destroyRating($id)
    {
        Log::info('In RatingApiController->destroyRating()');
        Log::info('Delete function  kaam kr rha hai');
        try {
            $access_token = $this->getRatingAccessToken();
            $url = ''
                . Config::get('app.SD_TEAM_RATING_MS_BASE_URL')
                . Config::get('app.SD_TEAM_RATING_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from RatingApiController::getRatingAccessToken(). Now fetching rating!');
            Log::info('Rating Delete Url: ' . $url);
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
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in RatingApiController->destroyRating()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
