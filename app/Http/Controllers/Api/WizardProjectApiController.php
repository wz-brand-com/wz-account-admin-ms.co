<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class WizardProjectApiController extends Controller
{
    // access token function start
    public static function wizardProjectAccessToken()
    {
        Log::info('In WizardProjectApiController->wizardProjectAccessToken()');
        try{
            Log::info('SD_WIZARD_PROJECT_MS_BASE_URL . SD_WIZARD_PROJECT_MS_OAUTH_TOKEN_URL: ' . Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL') . Config::get('app.SD_WIZARD_PROJECT_MS_OAUTH_TOKEN_URL'));
            Log::info('SD_WIZARD_PROJECT_MS_GRAND_TYPE: ' . Config::get('app.SD_WIZARD_PROJECT_MS_GRAND_TYPE'));
            Log::info('SD_WIZARD_PROJECT_MS_CLIENT_ID: ' . Config::get('app.SD_WIZARD_PROJECT_MS_CLIENT_ID'));
            Log::info('SD_WIZARD_PROJECT_MS_SECRET: ' . Config::get('app.SD_WIZARD_PROJECT_MS_SECRET'));
            Log::info('Getting the token!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL') . Config::get('app.SD_WIZARD_PROJECT_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_WIZARD_PROJECT_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_WIZARD_PROJECT_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_WIZARD_PROJECT_MS_SECRET'),
                        'redirect_uri' => '',
                    ],
                ]
            );
            $array = $response->getBody()->getContents();
            $json = json_decode($array, true);
            $collection = collect($json);
            $access_token = $collection->get('access_token');
            Log::info('Got the token in december!');    
            return $access_token;
        } catch(RequestException $e){
            Log::info('There is some exception in WizardProjectApiController->wizardProjectAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get wizard project function
    public function getWizardProjectValue($slug_id)
    {
        
        try{
            Log::info('SD_WIZARD_PROJECT_MS_ALL_URL: ' . Config::get('app.SD_WIZARD_PROJECT_MS_ALL_URL'));
            $access_token = $this->wizardProjectAccessToken();
            $url = ''
            .Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL')
            .Config::get('app.SD_WIZARD_PROJECT_MS_ALL_URL')
            .'/'
            .$slug_id;
            Log::info('Got the access token from WizardProjectApiController in this fuinction getWizardProjectValue step-one ');
            Log::info('ALL wizard project URL: ' . $url);
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
            Log::info('There was some exception in WizardProjectApiController->()getWizardProjectValue');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    public function storeWizardProject(Request $request)
    {
        
        Log::info('In WizardProjectApiController->storeWizardProject() step-one');
        $input = $request->all();
        Log::info('In WizardProjectApiController in this controller how many value ' .print_r($input,true));
        $validator = Validator::make($input, [
            'project_name' => 'required',
         
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => 'Please fill reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given wizard data...');
            $validatorResponse = $this->validateWizardProjectData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling WizardProjectApiController::wizardProjectAccessToken() step-three');
                $access_token = $this->wizardProjectAccessToken();
                Log::info('Got the access token from WizardProjectApiController::wizardProjectAccessToken(). Now creating Keyword! step-four' .$access_token);

                Log::info('SD_WIZARD_PROJECT_MS_BASE_URL . SD_WIZARD_PROJECT_MS_STORE_URL: ' . Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL') . Config::get('app.SD_WIZARD_PROJECT_MS_STORE_URL'));

                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL') . Config::get('app.SD_WIZARD_PROJECT_MS_STORE_URL'),
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
            Log::info('There was some exception in WizardProjectApiController->storeWizardProject()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    //validate wizard project function
    private function validateWizardProjectData(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
         'project_name' => 'required|string|max:255',
         
        ]);
        if($validator->fails()){
            return $response = [
                'success' => false,
                'message' => 'wizard project already available.'
            ];
        } else{
            return $response = [
                'success' => true,
                'message' => 'wizard project data is ready to store'
            ];
        }
    }

    //edit pagerank function
    public function edit_wizard_project(Request $request, $id)
    {
        Log::info("edit pe click ho rha hai to project ka id sholud " .print_r($id, true));
        Log::info('In WizardProjectApiController->edit_wizard_project()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->wizardProjectAccessToken();
            $url = ''
                . Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL')
                . Config::get('app.SD_WIZARD_PROJECT_MS_EDIT')
                .'/'
                .$id;
            Log::info('Got the access token from WizardProjectApiController::wizardProjectAccessToken().
            Now fetching wizard project!');
            Log::info('wizard project Edit Url: ' . $url);
            $guzzleClient = new Client(); //GuzzleHttp\Client
            $params = [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ]
            ];
            $response = $guzzleClient->request('GET', $url, $params);
            Log::info('Got the response from wizard project table');
            $json = json_decode($response->getBody()->getContents(), true);

            return $json;
        } catch (\Exception $e) {
            Log::info('There was some exception in WizardProjectApiController->editProject()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update wizard project function
    public function post_wizard_project(Request $request)
    {
        Log::info('In WizardProjectApiController->post_wizard_project()');
       
        $input = $request->all();
        Log::info('post krne pe hidden id aya ki nahi ' . $request->wizard_Hidden_id);
        $validator = Validator::make($input, [
            'project_name' => 'required|string|max:255',
          
          
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

            $validatorResponse = $this->validateWizardProjectData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling WizardProjectApiController::wizardProjectAccessToken()');
                $access_token = $this->wizardProjectAccessToken();
                Log::info('Got the access token from WizardProjectApiController::wizardProjectAccessToken(). Now Updating Keyword!');
                Log::info('update ka credential value aa rha hai');
                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL') . Config::get('app.SD_WIZARD_PROJECT_MS_UPDATE'),
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
            Log::info('There was some exception in WizardProjectApiController->post_wizard_project()');
            Log::info('wizard project update nahi ho rha hai');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    //destroy wizard project function
    public function delete_wizard_project($id)
    {
        Log::info('In WizardProjectApiController->destroyPagerank()');
        Log::info('Delete function kaam kr rha hai');
        try {
            $access_token = $this->wizardProjectAccessToken();
            $url = ''
                . Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL')
                . Config::get('app.SD_WIZARD_PROJECT_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from WizardProjectApiController::wizardProjectAccessToken(). Now fetching pagerank!');
            Log::info('wizard project Delete Url: ' . $url);
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
            Log::info('There was some exception delete nahi ho rha hai in WizardProjectApiController->destroyPagerank()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

     //creating function for getting all values anywhere in ms
    public static function getvalueall($slug_id) {

        Log::info('In 28-07-2021 WizardProjectApiController->getvalueall()'.$slug_id);
        try {
            Log::info('SD_WIZARD_PROJECT_MS_BASE_URL . SD_WIZARD_PROJECT_MS_ALL_URL: ' . Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL') . Config::get('app.SD_WIZARD_PROJECT_MS_ALL_URL'));
            Log::info('Calling WizardProjectApiController->wizardProjectAccessToken()');
            $access_token = WizardProjectApiController::wizardProjectAccessToken();
            Log::info('Got the access token from WizardProjectApiController->wizardProjectAccessToken().');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                 Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL') . Config::get('app.SD_WIZARD_PROJECT_MS_ALL_URL').'/'.$slug_id,
                
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
            Log::info('There was some exception in WizardProjectApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    // on change project based page url will be come open
    // onchange function via url_id
    public static function getProjectById(Request $request,$project_name_id)
    {
        Log::info('in WizardProjectApiController->getProjectById()');
        Log::info('project ka id ye hai'.$project_name_id);
        try{
            $access_token = WizardProjectApiController::wizardProjectAccessToken();
            Log::info('Got the access token from WizardProjectApiController->wizardProjectAccessToken(). Now fetching project!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_WIZARD_PROJECT_MS_BASE_URL') . Config::get('app.SD_WIZARD_PROJECT_MS_GETPROJECT_URL')
                .'/'
                .$project_name_id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from project!');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
           
            // return $json['data'];
            return $json;
        } catch(\Exception $e){
            Log::info('project  ka value nahi aaye ');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    // on change project based page url will be come close
}
