<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class IntervalApiController extends Controller
{
    // generating access token
    private function getIntervalAccessToken()
    {
        Log::info('In IntervalApiController->getIntervalAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_INTERVAL_TASK_MS_BASE_URL') . Config::get('app.SD_INTERVAL_TASK_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_INTERVAL_TASK_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_INTERVAL_TASK_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_INTERVAL_TASK_MS_SECRET'),
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
            Log::info('There is some exception in IntervalApiController->getIntervalAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get Email function 
    public function getInterval($id,$admin_id,$task_freq)
    {
        
        Log::info('we are getting slug id in getinertal function ');
        Log::info('we are getting admin_id id in getinertal function ');
        Log::info('we are getting task_freq id in getinertal function ');
        try{
            Log::info('SD_INTERVAL_TASK_MS_ALL_URL: ' . Config::get('app.SD_INTERVAL_TASK_MS_ALL_URL'));
            $access_token = $this->getIntervalAccessToken();
            $url = ''
            .Config::get('app.SD_INTERVAL_TASK_MS_BASE_URL')
            // .Config::get('app.SD_INTERVAL_TASK_MS_ALL_URL').'?id='.$id.'&task_freq='.$task_freq;
            .Config::get('app.SD_INTERVAL_TASK_MS_ALL_URL').'/'.$id.'/'.$admin_id.'/'.$task_freq;
            Log::info('Got the access token from IntervalApiController::getIntervalAccessToken(). Now fetching Web Access Data!');
            
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' =>[
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' .$access_token
                ]
            ];
            // dd($access_token);
           $response = $guzzleClient->request('GET', $url, $params);
           
            Log::info('Got the Response');
            Log::info('Store hone ke baad index page par value aa raha hai !');
            $json = json_decode($response->getBody()->getContents(), true);
            // Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            Log::info('There was some exception in IntervalApiController->getInterval()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    public function storeInterval(Request $request)
    {
        Log::info($request);
        Log::info('In IntervalApiController->storeInterval()');
        $input = $request->all();
        $validator = Validator::make($input, [
            'task_freq' => 'required',
            'task_details' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please Select reqiured fields.'       

            ];
        }
        try {
            $validatorResponse = $this->validateIntervalData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling IntervalApiController::getIntervalAccessToken()');
                $access_token = $this->getIntervalAccessToken();
                Log::info('Got the access token from IntervalApiController::getIntervalAccessToken()');

                Log::info('SD_INTERVAL_TASK_MS_BASE_URL . SD_INTERVAL_TASK_MS_STORE_URL: ' . Config::get('app.SD_INTERVAL_TASK_MS_BASE_URL') . Config::get('app.SD_INTERVAL_TASK_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_INTERVAL_TASK_MS_BASE_URL') . Config::get('app.SD_INTERVAL_TASK_MS_STORE_URL'),
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
            Log::info('There was some exception in IntervalApiController->storeInterval()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    //validate Interval function
    private function validateIntervalData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'task_freq' => 'required|string|max:255',
            'task_details' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Interval task already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Interval Task data is ready to store'
            ];
        }
    }

    //edit Interval task function
    public function editInterval(Request $request, $id)
    {
        Log::info('In IntervalApiController->editInterval()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getIntervalAccessToken();
            $url = ''
                . Config::get('app.SD_INTERVAL_TASK_MS_BASE_URL')
                . Config::get('app.SD_INTERVAL_TASK_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from IntervalApiController::getIntervalAccessToken()');
            Log::info('Interval Task Edit Url: ' . $url);
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
            Log::info('There was some exception in IntervalApiController->editInterval()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //update Inter function
    public function updateInterval(Request $request)
    {
        $input = $request->all();
        Log::info('$input[hidden_id]: ' . $request->hidden_id);
        $validator = Validator::make($input, [
            'task_freq' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given interval task data...');

            $validatorResponse = $this->validateIntervalData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling IntervalApiController::getIntervalAccessToken()');
                $access_token = $this->getIntervalAccessToken();
                Log::info('Got the access token from IntervalApiController::getIntervalAccessToken(). Now Updating Interval Task!');

                Log::info('SD_INTERVAL_TASK_MS_BASE_URL . SD_INTERVAL_TASK_MS_UPDATE: ' . Config::get('app.SD_INTERVAL_TASK_MS_BASE_URL') . Config::get('app.SD_INTERVAL_TASK_MS_UPDATE'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_INTERVAL_TASK_MS_BASE_URL') . Config::get('app.SD_INTERVAL_TASK_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                Log::info('Got the response!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in IntervalApiController->updateProject()');
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

    //destroy IntervalTask function
    public function destroyInterval($id)
    {
        Log::info('In IntervalApiController->destroyInterval()');
        Log::info('Delete function  kaam kr rha hai');
        try {
            $access_token = $this->getIntervalAccessToken();
            $url = ''
                . Config::get('app.SD_INTERVAL_TASK_MS_BASE_URL')
                . Config::get('app.SD_INTERVAL_TASK_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from IntervalApiController::getIntervalAccessToken(). Now fetching IntervalTask!');
            Log::info('IntervalTask Delete Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response! delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in IntervalApiController->destroyInterval()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
