<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use Config;
use Validator;
use Auth;

class TaskboardApiController extends Controller
{
    //generating access token as static for getvalueall function
    private static function getTaskBoardAccessToken()
    {
        Log::info('In TaskboardApiController->getTaskBoardAccessToken()');
        try{
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_TASK_BOARD_MS_BASE_URL') . Config::get('app.SD_TASK_BOARD_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_TASK_BOARD_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_TASK_BOARD_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_TASK_BOARD_MS_SECRET'),
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
            Log::info('There is some exception in TaskboardApiController->getTaskBoardAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get url function
    public function getTaskboard($id)
    {
        Log::info('get task borad main value aaya by id'.$id);

        try{
            Log::info('SD_TASK_BOARD_MS_ALL_URL: ' . Config::get('app.SD_TASK_BOARD_MS_ALL_URL'));
            $access_token = $this->getTaskBoardAccessToken();
            $url = ''
            .Config::get('app.SD_TASK_BOARD_MS_BASE_URL')
            .Config::get('app.SD_TASK_BOARD_MS_ALL_URL')
            .'/'
            .$id;
            Log::info('Got the access token from TaskboardApiController::getTaskBoardAccessToken(). Now fetching URLs!');
            Log::info('Taskboard URL: ' . $url);
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
            // Log::info('Number of objects in response: ' . count($json['data']));
            return $json;
        } catch(\Exception $e){
            Log::info('There was some exception in TaskboardApiController->getTaskboard()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

    //store url function

    public function storeTaskboard(Request $request, $project_name)
    {
        Log::info($request);
        Log::info('In TaskboardApiController->storeTaskborad()');
        $input = $request->all();
        Log::info("task borad with this value".print_r($input,true));
        Log::info('$input[weburl]: ' . $request->weburl);
        Log::info('$input[project_name]: ' . $request->project_name);
        $validator = Validator::make($input, [
            'weburl' => 'required',
            'project_name' => 'required',
            'keyword' => 'required',
            'document' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                // 'message' => $validator->errors()
                'message' => 'Please Select reqiured fields.',
            ];
        }
        try {
            Log::info('Validating given Tack Board data...');
            $validatorResponse = $this->validateTaskBoardData($request);
            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling TaskboardApiController::getTaskBoardAccessToken()');
                $access_token = $this->getTaskBoardAccessToken();
                Log::info('Got the access token from TaskboardApiController::getTaskBoardAccessToken(). Now creating Task board!');

                Log::info('SD_TASK_BOARD_MS_BASE_URL . SD_TASK_BOARD_MS_STORE_URL: ' . Config::get('app.SD_TASK_BOARD_MS_BASE_URL') . Config::get('app.SD_TASK_BOARD_MS_STORE_URL'));

                // document is comming from blade page open
                $multipartArray = [];
                $resume = null;
            if (isset($input['document'])) {
                $resume = $input['document'];
            }
            $multipartArray[] = [
                'name'     => 'project_name',
                'contents' => $input['project_name']
            ];

            $multipartArray[] = [
                'name'     => 'weburl',
                'contents' => $input['weburl']
            ];
            $multipartArray[] = [
                'name'     => 'keyword',
                'contents' => $input['keyword']
            ];
            $multipartArray[] = [
                'name'     => 'severity',
                'contents' => $input['severity']
            ];
            $multipartArray[] = [
                'name'     => 'tasktype',
                'contents' => $input['tasktype']
            ];
            $multipartArray[] = [
                'name'     => 'taskdeadline',
                'contents' => $input['taskdeadline']
            ];
            $multipartArray[] = [
                'name'     => 'user',
                'contents' => $input['user']
            ];
            $multipartArray[] = [
                'name'     => 'status',
                'contents' => $input['status']
            ];
            $multipartArray[] = [
                'name'     => 'description',
                'contents' => $input['description']
            ];
            $multipartArray[] = [
                'name'     => 'admin_id',
                'contents' => $input['admin_id']
            ];
            $multipartArray[] = [
                'name'     => 'admin_email',
                'contents' => $input['admin_email']
            ];
            $multipartArray[] = [
                'name'     => 'user_id',
                'contents' => $input['user_id']
            ];
            $multipartArray[] = [
                'name'     => 'user_email',
                'contents' => $input['user_email']
            ];
            $multipartArray[] = [
                'name'     => 'u_org_slugname',
                'contents' => $input['u_org_slugname']
            ];
            $multipartArray[] = [
                'name'     => 'u_org_organization_id',
                'contents' => $input['u_org_organization_id']
            ];
            $multipartArray[] = [
                'name'     => 'u_org_role_id',
                'contents' => $input['u_org_role_id']
            ];
            $multipartArray[] = [
                'name'     => 'url_id',
                'contents' => $input['url_id']
            ];
            $multipartArray[] = [
                'name'     => 'project_id',
                'contents' => $input['project_id']
            ];
            $multipartArray[] = [
                'name'     => 'title',
                'contents' => $input['title']
            ];
            $multipartArray[] = [
                'name'     => 'document',
                'contents' => $input['document']
            ];
            
           
           
            array_push($multipartArray,[
                'name' => 'project_name',             
                'contents' => $input['project_name']  
            ]);
            array_push($multipartArray,[
                'name' => 'weburl',             
                'contents' => $input['weburl']  
            ]);
            array_push($multipartArray,[
                'name' => 'keyword',             
                'contents' => $input['keyword']  
            ]);
            array_push($multipartArray,[
                'name' => 'severity',             
                'contents' => $input['severity']  
            ]);
            array_push($multipartArray,[
                'name' => 'tasktype',             
                'contents' => $input['tasktype']  
            ]);
            array_push($multipartArray,[
                'name' => 'taskdeadline',             
                'contents' => $input['taskdeadline']  
            ]);
            array_push($multipartArray,[
                'name' => 'user',             
                'contents' => $input['user']  
            ]);
            array_push($multipartArray,[
                'name' => 'status',             
                'contents' => $input['status']  
            ]);
            array_push($multipartArray,[
                'name' => 'description',             
                'contents' => $input['description']  
            ]);
            array_push($multipartArray,[
                'name' => 'admin_id',             
                'contents' => $input['admin_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'admin_email',             
                'contents' => $input['admin_email']  
            ]);
            array_push($multipartArray,[
                'name' => 'user_id',             
                'contents' => $input['user_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'user_email',             
                'contents' => $input['user_email']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_slugname',             
                'contents' => $input['u_org_slugname']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_organization_id',             
                'contents' => $input['u_org_organization_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_role_id',             
                'contents' => $input['u_org_role_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'url_id',             
                'contents' => $input['url_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'project_id',             
                'contents' => $input['project_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'title',             
                'contents' => $input['title']  
            ]);
           
            array_push($multipartArray,[
                'name' => 'document',             // here name should be db name
                'contents' => $input['document']  // here name from blade name 
            ]);
           
          
            array_push($multipartArray,[
                'name'     => 'document',
                'contents' => file_get_contents($resume),
                'filename' => $resume->getClientOriginalName()
            ]);
                // document is comming from blade page close
                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_TASK_BOARD_MS_BASE_URL') . Config::get('app.SD_TASK_BOARD_MS_STORE_URL')
                    . '/'
                    .$project_name,
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        // 'form_params' => $request->all()
                        'multipart' => $multipartArray
                    ]
                );
                // Log:info('$http' . $http);
                Log::info('Got the response from Task board ');
                Log::info('data store ho gaya hai successfully');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }   

        } catch (\Exception $e) {
            Log::info('There was some exception in TaskboardApiController->getTaskboard()');
            Log::info($e->getMessage());
            $response = [
                'success' => false,
                'data' => '' ,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }


    // ajay controller oepn
    // public static function cvRegisterForJobs(Request $request) {
    //     Log::info('In CvController->cvRegisterForJobs()');
    //     $input = $request->all();
    //      Log::info('$input[email] cvRegisterForJobs: ' . $request->email);
    //      Log::info('$input[name]  cvRegisterForJobs: ' . $request->name);
    //     $validator = Validator::make($input, [
    //         'email' => 'required',
    //         'name' =>'required',
    //         'phone' =>'required',
    //         'country_id' =>'required',
    //         'state_id' =>'required',
    //         'work_experience' =>'required',
    //         'city_id' =>'required',
    //         'jobs_resume' => 'required|file|mimes:jpeg,png,pdf|max:2048'
    //     ]);
    //     if ($validator->fails()) {
    //         return $response = [
    //             'success' => false,
    //             'message' => $validator->errors()
    //         ];
    //     }
        
    //     try {
    //         $validatorResponse = CvController::validateRegisterCvData($request);
    //         Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
    //         Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
    //         if ($validatorResponse['success']) {
    //             Log::info('Calling CvController::getCvManagementAccessToken()');
    //             $access_token = CvController::getCvManagementAccessToken();
    //             Log::info('Got the access token from CvController::getCvManagementAccessToken(). Now creating Jobs Apply!');
    //             Log::info('CV_M_BASE_URL . CREATE_CV_REGISTER_JOBS_URL: ' . Config::get('app.CV_M_BASE_URL') . Config::get('app.CREATE_CV_REGISTER_JOBS_URL'));
    //             $multipartArray = [];
    //             $resume = null;
    //         if (isset($input['jobs_resume'])) {
    //             $resume = $input['jobs_resume'];
    //         }
    //         $multipartArray[] = [
    //             'name'     => 'email',
    //             'contents' => $input['email']
    //         ];
    //         $multipartArray[] = [
    //             'name'     => 'work_experience',
    //             'contents' => $input['work_experience']
    //         ];
    //         array_push($multipartArray,[
    //             'name' => 'name',
    //             'contents' => $input['name']
    //         ]);
    //         array_push($multipartArray,[
    //             'name'     => 'phone',
    //             'contents' => $input['phone']
    //         ]);
    //         array_push($multipartArray,[
    //             'name'     => 'country_id',
    //             'contents' => $input['country_id']
    //         ]);
    //         array_push($multipartArray,[
    //             'name'     => 'state_id',
    //             'contents' => $input['state_id']
    //         ]);
    //         array_push($multipartArray,[
    //             'name'     => 'city_id',
    //             'contents' => $input['city_id']
    //         ]);
    //         array_push($multipartArray,[
    //             'name'     => 'jobs_resume',
    //             'contents' => file_get_contents($resume),
    //             'filename' => $resume->getClientOriginalName()
    //         ]);
    //         $http = new Client(); //GuzzleHttp\Client
    //         $response = $http->post(
    //             Config::get('app.CV_M_BASE_URL') . Config::get('app.CREATE_CV_REGISTER_JOBS_URL'),
    //             [
    //                 'headers' => [
    //                     'Accept'     => 'application/json',
    //                     'Authorization' => 'Bearer ' . $access_token
    //                 ],
    //                 'multipart' => $multipartArray
    //             ]
    //         );
    //             Log::info('Got the response from create Training!');
    //             $responseJson = json_decode($response->getBody()->getContents(), true);
    //             return response()->json($responseJson, 200);
    //          } else {
    //             return response()->json($responseJson, 422);
    //     }
    //     } catch (\Exception $e) {
    //             Log::info('There was some exception in JobController->cvRegisterForJobs()');
    //             Log::info($e->getMessage());
    //             $response = [
    //                 'success' => false,
    //                 'data' => '' ,
    //                 'message' => $e->getMessage()
    //             ];
    //             return response()->json($response, 500);
    //     }
    // }
    // Cv from JobController end
    // ajay controller close

    //validate url function validateTaskBoardData
    private function validateTaskBoardData(Request $request)
    {
        $input = $request->all();   
        $validator = Validator::make($input,[
            'weburl' => 'required|string|max:255',
            'project_name' => 'required|string|max:255'
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
    public function editTaskboard(Request $request, $id)
    {
        Log::info('In TaskboardApiController->editTaskboard()');
        Log::info('edit page ka value aa rha hai ');
        try {
            $access_token = $this->getTaskBoardAccessToken();
            $url = ''
                . Config::get('app.SD_TASK_BOARD_MS_BASE_URL')
                . Config::get('app.SD_TASK_BOARD_MS_EDIT')
                .'/'
                .$id;
            Log::info('Got the access token from TaskboardApiController::getTaskBoardAccessToken().
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
            Log::info('There was some exception in TaskboardApiController->editProject()');
            Log::info('value edit page pe nahi aa raha hai');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    //update url function
    public function updateTaskboard(Request $request)
    {
        //     $selected_image = $request->file_document_show;
        //  Log::info('In TaskBoardController->update(selected_image): '.print_r($selected_image,true));
   
        $input = $request->all();
         Log::info('$input[document]: ' . $request->document);
         Log::info('$input[project_name]: ' . $request->project_name);
         log::info('hiden id send by update function ' . $request->hidden_id);
        $validator = Validator::make($input, [
            'weburl' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
        }
        try {
            Log::info('Validating given Update Task Board data...');

                $validatorResponse = $this->validateTaskBoardData($request);

            Log::info('$validatorResponse[success]: ' . $validatorResponse['success']);
            Log::info('$validatorResponse[message]: ' . $validatorResponse['message']);
            if ($validatorResponse['success']) {

                Log::info('Calling TaskboardApiController::getTaskBoardAccessToken()');
                $access_token = $this->getTaskBoardAccessToken();
                Log::info('Got the access token from TaskboardApiController::getTaskBoardAccessToken(). Now Updating Url!');

                Log::info('SD_TASK_BOARD_MS_BASE_URL . SD_TASK_BOARD_MS_UPDATE: ' . Config::get('app.SD_TASK_BOARD_MS_BASE_URL') 
                . Config::get('app.SD_TASK_BOARD_MS_STORE_URL'));

                $multipartArray = [];
              
           
             if($request->document == ''){

             Log::info('if ke  ander ke aaa agay ahi.');     
            array_push($multipartArray,[
                'name' => 'hidden_id',             
                'contents' => $input['hidden_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'user_hidden_id',             
                'contents' => $input['user_hidden_id']  
            ]);
           
            array_push($multipartArray,[
                'name' => 'project_name',             
                'contents' => $input['project_name']  
            ]);
            array_push($multipartArray,[
                'name' => 'weburl',             
                'contents' => $input['weburl']  
            ]);
            array_push($multipartArray,[
                'name' => 'keyword',             
                'contents' => $input['keyword']  
            ]);
            array_push($multipartArray,[
                'name' => 'severity',             
                'contents' => $input['severity']  
            ]);
            array_push($multipartArray,[
                'name' => 'tasktype',             
                'contents' => $input['tasktype']  
            ]);
            array_push($multipartArray,[
                'name' => 'taskdeadline',             
                'contents' => $input['taskdeadline']  
            ]);
            array_push($multipartArray,[
                'name' => 'user',             
                'contents' => $input['user']  
            ]);
            array_push($multipartArray,[
                'name' => 'status',             
                'contents' => $input['status']  
            ]);
            array_push($multipartArray,[
                'name' => 'description',             
                'contents' => $input['description']  
            ]);
            array_push($multipartArray,[
                'name' => 'admin_id',             
                'contents' => $input['admin_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'admin_email',             
                'contents' => $input['admin_email']  
            ]);
            array_push($multipartArray,[
                'name' => 'user_id',             
                'contents' => $input['user_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'user_email',             
                'contents' => $input['user_email']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_slugname',             
                'contents' => $input['u_org_slugname']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_organization_id',             
                'contents' => $input['u_org_organization_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_role_id',             
                'contents' => $input['u_org_role_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'url_id',             
                'contents' => $input['url_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'project_id',             
                'contents' => $input['project_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'title',             
                'contents' => $input['title']  
            ]);
           
            // array_push($multipartArray,[
            //     'name' => 'document',             // here name should be db name
            //     'contents' => $input['document']  // here name from blade name 
            // ]);
           
          
            // array_push($multipartArray,[
            //     'name'     => 'document',
            //     'contents' => file_get_contents($resume),
            //     'filename' => $resume->getClientOriginalName()
            // ]);
        }  
        else{
            Log::info('else ke  ander ke aaa agay ahi.');     

            $resume = null;
            if (isset($input['document'])) {
                $resume = $input['document'];
            }
            array_push($multipartArray,[
                'name' => 'hidden_id',             
                'contents' => $input['hidden_id']  
            ]);
           
            array_push($multipartArray,[
                'name' => 'project_name',             
                'contents' => $input['project_name']  
            ]);
            array_push($multipartArray,[
                'name' => 'weburl',             
                'contents' => $input['weburl']  
            ]);
            array_push($multipartArray,[
                'name' => 'keyword',             
                'contents' => $input['keyword']  
            ]);
            array_push($multipartArray,[
                'name' => 'severity',             
                'contents' => $input['severity']  
            ]);
            array_push($multipartArray,[
                'name' => 'tasktype',             
                'contents' => $input['tasktype']  
            ]);
            array_push($multipartArray,[
                'name' => 'taskdeadline',             
                'contents' => $input['taskdeadline']  
            ]);
            array_push($multipartArray,[
                'name' => 'user',             
                'contents' => $input['user']  
            ]);
            array_push($multipartArray,[
                'name' => 'status',             
                'contents' => $input['status']  
            ]);
            array_push($multipartArray,[
                'name' => 'description',             
                'contents' => $input['description']  
            ]);
            array_push($multipartArray,[
                'name' => 'admin_id',             
                'contents' => $input['admin_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'admin_email',             
                'contents' => $input['admin_email']  
            ]);
            array_push($multipartArray,[
                'name' => 'user_id',             
                'contents' => $input['user_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'user_email',             
                'contents' => $input['user_email']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_slugname',             
                'contents' => $input['u_org_slugname']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_organization_id',             
                'contents' => $input['u_org_organization_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'u_org_role_id',             
                'contents' => $input['u_org_role_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'url_id',             
                'contents' => $input['url_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'project_id',             
                'contents' => $input['project_id']  
            ]);
            array_push($multipartArray,[
                'name' => 'title',             
                'contents' => $input['title']  
            ]);
           
            array_push($multipartArray,[
                'name' => 'document',             // here name should be db name
                'contents' => $input['document']  // here name from blade name 
            ]);
           
          
            array_push($multipartArray,[
                'name'     => 'document',
                'contents' => file_get_contents($resume),
                'filename' => $resume->getClientOriginalName()
            ]);
        }
                $http = new Client(); //GuzzleHttp\Client
                $response = $http->post(
                    Config::get('app.SD_TASK_BOARD_MS_BASE_URL') . Config::get('app.SD_TASK_BOARD_MS_UPDATE'),
                    [
                        'headers' => [
                            'Accept'     => 'application/json',
                            'Authorization' => 'Bearer ' . $access_token
                        ],
                        // 'form_params' => $request->all() // form_prams means all data send by request
                        'multipart' => $multipartArray
                    ]
                );
                Log::info('value update ho gaya hai');
                Log::info('Got the response from create manager!');
                $responseJson = json_decode($response->getBody()->getContents(), true);

                return response()->json($responseJson, 200);
            } else {
                return response()->json($responseJson, 422);
            }

        } catch (\Exception $e) {
            Log::info('There was some exception in TaskboardApiController->updateProject()');
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
    public function destroyTaskboard($id)
    {
        Log::info('In TaskboardApiController->destroyTaskboard()');
        Log::info('Delete function  kaam kr rha hai');
        try {
            $access_token = $this->getTaskBoardAccessToken();
            $url = ''
                . Config::get('app.SD_TASK_BOARD_MS_BASE_URL')
                . Config::get('app.SD_TASK_BOARD_MS_DELETE_URL')
                .'/'
                .$id;
            Log::info('Got the access token from TaskboardApiController::getTaskBoardAccessToken(). Now fetching Taskboard!');
            Log::info('Taskboard Delete Url: ' . $url);
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
            Log::info('There was some exception delete nahi ho rha hai in TaskboardApiController->destroyTaskboard()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //creating function for getting all values anywhere in ms
    public static function getvalueall() {

        Log::info('In TaskboardApiController->getvalueall()');
        try {
            Log::info('SD_TASK_BOARD_MS_BASE_URL . SD_TASK_BOARD_MS_ALL_URL: ' . Config::get('app.SD_TASK_BOARD_MS_BASE_URL') . Config::get('app.SD_TASK_BOARD_MS_ALL_URL'));
            Log::info('Calling TaskboardApiController->getTaskBoardAccessToken()');
            $access_token = TaskboardApiController::getTaskBoardAccessToken();
            Log::info('Got the access token from TaskboardApiController->getTaskBoardAccessToken(). Now fetching urls!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_TASK_BOARD_MS_BASE_URL') . Config::get('app.SD_TASK_BOARD_MS_ALL_URL').'/'.Auth::user()->id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from URL!');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json['data'];
        } catch (\Exception $e) {
            Log::info('There was some exception in TaskboardApiController->getvalueall()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
    // onchange function via project_id
    public static function getProjectid(Request $request,$project_id)
    {
        Log::info('in TaskboardApiController->getProjectid()');
        Log::info('project ka id ye hai'.'=>'.$project_id);
        try{
            $access_token = TaskboardApiController::getTaskBoardAccessToken();
            Log::info('Got the access token from TaskboardApiController->getTaskBoardAccessToken(). Now fetching url!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                Config::get('app.SD_TASK_BOARD_MS_BASE_URL') . Config::get('app.SD_ADD_URLS_MS_GETPROJECT_URL')
                .'/'
                .$project_id,
                [
                    'headers' => [
                        'Accept'     => 'application/json',
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            Log::info('Got the response from URL!');
            $json = json_decode($response->getBody()->getContents(), true);
            Log::info('Number of objects in response: ' . count($json['data']));
            return $json['data'];
        } catch(\Exception $e){
            Log::info('ye aa gye ham error part me');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }
}
