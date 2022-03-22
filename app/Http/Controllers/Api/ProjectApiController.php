<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;      
use Config;
use Validator;
use Auth;

class ProjectApiController extends Controller
{
    private static function getProjectAccessToken()
    {
        Log::info('In ProjectApiController->getProjectAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_PROJECTS_MS_BASE_URL') . Config::get('app.SD_PROJECTS_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_PROJECTS_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_PROJECTS_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_PROJECTS_MS_SECRET'),
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
            Log::info('There is some exception in ProjectApiController->getProjectAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get project function
    public function getProject($slug_id)
    {
        
        try{
            Log::info('SD_PROJECTS_MS_ALL_URL: ' . Config::get('app.SD_PROJECTS_MS_ALL_URL'));
            $access_token = $this->getProjectAccessToken();
            $url = ''
            .Config::get('app.SD_PROJECTS_MS_BASE_URL')
            .Config::get('app.SD_PROJECTS_MS_ALL_URL')
            .'/'
            .$slug_id;
            Log::info('Got the access token from ProjectApiController::getProjectAccessToken(). Now fetching User!');
            Log::info('ALL Project URL: ' . $url);
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
            Log::info('There was some exception in ProjectApiController->getProject()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //store project function

    public function storeProject(Request $request)
    {
        Log::info($request);
        Log::info('In ProjectApiController->storeProject()');
        $input = $request->all();
         Log::info('$input[project_name]: ' . $request->project_name);
         Log::info('$input[project_manager]: ' . $request->project_manager);
        $validator = Validator::make($input, [
            'project_name' => 'required',
            'project_manager' => 'required',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please fill reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given project data...');
            $validatorResponse = $this->validateProjectData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling ProjectApiController::getProjectAccessToken()');
                $access_token = $this->getProjectAccessToken();
                Log::info('Got the access token from ProjectApiController::getProjectAccessToken(). Now creating Project!');

                Log::info('SD_PROJECTS_MS_BASE_URL . SD_PROJECTS_MS_STORE_URL: ' . Config::get('app.SD_PROJECTS_MS_BASE_URL') . Config::get('app.SD_PROJECTS_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_PROJECTS_MS_BASE_URL') . Config::get('app.SD_PROJECTS_MS_STORE_URL'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        'form_params' => $request->all()
                    ]
                );
                
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in ProjectApiController->getProject()');
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
    private function validateProjectData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'project_name' => 'required|string|max:255',
            // 'project_manager' => 'required|string|max:255'
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'Project already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'Project data is ready to store'
            ];
        }
    }


    //edit project function
    public function editProject(Request $request, $id)
    {
        Log::info('In ProjectApiController->editProject()');
        try {
            $access_token = $this->getProjectAccessToken();
            $url = ''
                . Config::get('app.SD_PROJECTS_MS_BASE_URL')
                . Config::get('app.SD_PROJECTS_MS_EDIT')
                .'/'
                .$id;

            Log::info('Got the access token from ProjectApiController::getProjectAccessToken().
            Now fetching project!');
            Log::info('Project Edit Url: ' . $url);
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
            Log::info('There was some exception in ProjectApiController->editProject()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update project function
    public function updateProject(Request $request)
    {
        Log::info('In ProjectApiController->updateProject()');
        Log::info($request);
        $input = $request->all();
         
        $validator = Validator::make($input, [
            'project_name' => 'required|string|max:255',
            'project_manager' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given project data...');
            $validatorResponse = $this->validateProjectData($request);
           
            if ($validatorResponse['success']) {

                Log::info('Calling ProjectApiController::getProjectAccessToken()');
                $access_token = $this->getProjectAccessToken();
                Log::info('Got the access token from ProjectApiController::getProjectAccessToken(). Now Updating Project!');
                Log::info('SD_PROJECTS_MS_BASE_URL . SD_PROJECTS_MS_UPDATE: ' . Config::get('app.SD_PROJECTS_MS_BASE_URL') . Config::get('app.SD_PROJECTS_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_PROJECTS_MS_BASE_URL') . Config::get('app.SD_PROJECTS_MS_UPDATE'),
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
            Log::info('There was some exception in ProjectApiController->updateProject()');
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
    public function destroyProject($id)
    {
       
        try {
            $access_token = $this->getProjectAccessToken();
            $url = ''
                . Config::get('app.SD_PROJECTS_MS_BASE_URL')
                . Config::get('app.SD_PROJECTS_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from ProjectApiController::getProjectAccessToken(). Now fetching projects!');
            Log::info('Project Delete Url: ' . $url);
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
            Log::info('There was some exception delete nahi ho rha hai in ProjectApiController->destroyProject()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //creating function for getting all values anywhere in ms
    public static function getvalueall($slug_id) {

        Log::info('In 28-07-2021 ProjectApiController->getvalueall()');
        try {
            Log::info('SD_PROJECTS_MS_BASE_URL . SD_PROJECTS_MS_ALL_URL: ' . Config::get('app.SD_PROJECTS_MS_BASE_URL') . Config::get('app.SD_PROJECTS_MS_ALL_URL'));
            Log::info('Calling ProjectApiController->getProjectAccessToken()');
            $access_token = ProjectApiController::getProjectAccessToken();
            Log::info('Got the access token from ProjectApiController->getProjectAccessToken(). Now fetching courses!'.$access_token);
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                 Config::get('app.SD_PROJECTS_MS_BASE_URL') . Config::get('app.SD_PROJECTS_MS_ALL_URL').'/'.$slug_id,
                
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            $json = json_decode($response->getBody()->getContents(), true);
           
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in ProjectApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
