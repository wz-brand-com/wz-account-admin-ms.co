<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Config;
use GuzzleHttp\Client as Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;  

class TaskApiController extends Controller
{
    //Generating AccessToken
    private static function getTaskAccessToken()
    {
        Log::info('In TaskApiController-> getTaskAccessToken()');
        try {
            Log::info('SD_TASK_TYPE_MS_BASE_URL:' . Config::get('app.SD_TASK_TYPE_MS_BASE_URL'));
            Log::info('SD_TASK_TYPE_MS_GRAND_TYPE: ' . Config::get('app.SD_TASK_TYPE_MS_GRAND_TYPE'));
            Log::info('SD_TASK_TYPE_MS_CLIENT_ID: ' . Config::get('app.SD_TASK_TYPE_MS_CLIENT_ID'));
            Log::info('SD_TASK_TYPE_MS_SECRET: ' . Config::get('app.SD_TASK_TYPE_MS_SECRET'));
            Log::info('SD_TASK_TYPE_MS_OAUTH_TOKEN_URL: ' . Config::get('app.SD_TASK_TYPE_MS_OAUTH_TOKEN_URL'));
            Log::info('Getting the token!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_TASK_TYPE_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_TASK_TYPE_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_TASK_TYPE_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_TASK_TYPE_MS_SECRET'),
                        'redirect_uri' => '',
                    ],
                ]
            );
            Log::info('response aa gya');
            $array = $response->getBody()->getContents();
            $json = json_decode($array, true);
            $collection = collect($json);
            $access_token = $collection->get('access_token');
            Log::info('Got the token!');
            return $access_token;
        } catch (RequestException $e) {
            Log::info('There is some exception in TaskApiController->getTaskAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    public function getTask($slug_id)
    {

        Log::info('In TaskApiController->getTask()->2nd method calling');
        try {
            Log::info('SD_TASK_TYPE_MS_ALL_URL: ' . Config::get('app.SD_TASK_TYPE_MS_ALL_URL'));
            $access_token = $this->getTaskAccessToken();
            $url = ''
            . Config::get('app.SD_TASK_TYPE_MS_BASE_URL')
            . Config::get('app.SD_TASK_TYPE_MS_ALL_URL')
                . '/'
                . $slug_id;
            Log::info('Got the access token from TaskApiController::getTaskAccessToken(). Now fetching User!');
            Log::info('ALL URL: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token,
                ],
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the Response from SD Tasktype MS');
            Log::info('Store hone ke baad index page par value aa raha hai !');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception in TaskApiController->getTask()');
            return $e->getResponse()->getStatusCode() . ':' . $e->getMessage();
        }
    }

    public function storeTask(Request $request)
    {
        Log::info('In TaskApiController->storeTask()');
        $input = $request->all();
        Log::info('$input[task_type]: ' . $request->task_type);
        Log::info('u_org_role_id: ' . $request);
        $validator = Validator::make($input, [
            'task_type' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please fill reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given task type data...');
            $validatorResponse = $this->validateNewTaskData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling TaskApiController::getTaskAccessToken()');
                $access_token = $this->getTaskAccessToken();
                Log::info('Got the access token from TaskApiController::getTaskAccessToken(). Now creating Task!');

                Log::info('SD_TASK_TYPE_MS_BASE_URL . SD_TASK_TYPE_MS_STORE_URL: ' . Config::get('app.SD_TASK_TYPE_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_TASK_TYPE_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token,
                        ],
                        'form_params' => $request->all(),
                    ]
                );
                // Log:info('$http' . $http);
                Log::info('Got the response from create Task type ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in TaskApiController->getTaskType()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '',
                'message' => $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    //function for validating new Task Type
    private function validateNewTaskData(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'task_type' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => 'task type already registered.',
            ];
        } else {
            return $response = [
                'success' => true,
                'message' => 'task type User data is ok to store.',
            ];
        }
    }

    // edit function start
    public function edit(Request $request, $id)
    {
        Log::info('In TaskApiController->editTaskType()');
        log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getTaskAccessToken();
            $url = ''
            . Config::get('app.SD_TASK_TYPE_MS_BASE_URL')
            . Config::get('app.SD_TASK_TYPE_MS_EDIT')
                . '/'
                . $id;

            Log::info('Got the access token from TaskApiController::getTaskAccessToken().
            Now fetching categories!');
            Log::info('Task Edit Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token,
                ],
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from task!');
            $json = json_decode($response->getBody()->getContents(), true);

            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception in TaskApiController->getTaskType()');
            log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    // update function start
    public function updateTask(Request $request)
    {
        Log::info('In TaskApiController->update()');
        $input = $request->all();
        Log::info('$input[task_type]: ' . $request->task_type);
        log::info('$input[hidden_id]: ' . $request->hidden_id);
        $validator = Validator::make($input, [
            'task_type' => 'required|string|max:255',

        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors(),
            ];
        }
        try {
            Log::info('Validating given Task Type data...');

            $validatorResponse = $this->validateNewTaskData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling TaskApiController::getTaskAccessToken()');
                $access_token = $this->getTaskAccessToken();
                Log::info('Got the access token from TaskApiController::getTaskAccessToken(). Now creating task!');

                Log::info('SD_TASK_TYPE_MS_BASE_URL . SD_TASK_TYPE_MS_UPDATE: ' . Config::get('app.SD_TASK_TYPE_MS_BASE_URL') .
                    Config::get('app.SD_TASK_TYPE_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_TASK_TYPE_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token,
                        ],
                        'form_params' => $request->all(),
                    ]
                );
                Log::info('Got the response from create Task Type!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in TaskApiController->update()');
            Log::info('update nahi ho rha hai');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '',
                'message' => $e->getMessage(),
            ];

            return response()->json($response, 500);
        }
    }

    // update function close

    public function destroyTask($id)
    {
        Log::info('In TaskApiController->destroyTask()');
        Log::info('delete function kaam kr rha hai in account admin page');
        try {
            $access_token = $this->getTaskAccessToken();
            $url = ''
            . Config::get('app.SD_TASK_TYPE_MS_BASE_URL')
            . Config::get('app.SD_TASK_TYPE_MS_DELETE_URL')
                . '/'
                . $id;
            Log::info('Got the access token from TaskApiController::getTaskAccessToken(). Now fetching categories!');
            Log::info('Task Type Delete Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token,
                ],
            ];

            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from data! delete ho gaya successfully..');
            $json = json_decode($response->getBody()->getContents(), true);
            // Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception delete nahi ho rha hai in TaskApiController->getTaskType()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    public static function getvalueall($slug_id)
    {
        Log::info('In TaskApiController->getvalueall()');
        try {
            Log::info('SD_TASK_TYPE_MS_BASE_URL . SD_TASK_TYPE_MS_ALL_URL: ' . Config::get('app.SD_TASK_TYPE_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_MS_ALL_URL'));
            Log::info('Calling TaskApiController->getTaskAccessToken()');
            $access_token = TaskApiController::getTaskAccessToken();
            Log::info('Got the access token from TaskApiController->getTaskAccessToken(). Now fetching Task type!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_TASK_TYPE_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_MS_ALL_URL') . '/' .$slug_id,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token,
                    ],
                ]
            );

            Log::info('Got the response from Task Type!');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in TaskApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
