<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use Validator;

class TaskTypeGetSiteAdminController extends Controller
{
    private static function getTaskBoardAccessToken()
    {
        Log::info('In ProjectApiController->getTaskBoardAccessToken()');
        try{
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL:'. Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL'));
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_GRAND_TYPE: ' . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_GRAND_TYPE'));
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_CLIENT_ID: ' . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_CLIENT_ID'));
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_SECRET: ' . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_SECRET'));
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_OAUTH_TOKEN_URL: ' . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_OAUTH_TOKEN_URL'));
            Log::info('Getting the token!');
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->post(
                Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_OAUTH_TOKEN_URL'),
                [
                    'form_params' => [
                        'grant_type' => Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_GRAND_TYPE'),
                        'client_id' => Config::get('app.SD_PROJECTS_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_SECRET'),
                        'redirect_uri' => '',
                    ],
                ]
            );
            $array = $response->getBody()->getContents();
            $json = json_decode($array, true);
            $collection = collect($json);
            $access_token = $collection->get('access_token');
            Log::info('Got the token! : ajay '.$access_token);
            return $access_token;
        } catch(RequestException $e){
            Log::info('There is some exception in ProjectApiController->getTaskBoardAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get project function
    public static function getValueAllSiteAdmin($slug_id)
    {
        Log::info('getValueAllSiteAdmin'.$slug_id);
        try{
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL: ' . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL'));
            $access_token = TaskTypeGetSiteAdminController::getTaskBoardAccessToken();
            Log::info('token is coming from taskboard to site admin'.$access_token);
            $url = ''
            .Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL')
            .Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL')
            .'/'
            .$slug_id;
            Log::info('Now fetching '.$url);
            Log::info('ALL task type url is coming from site admin : ' . $url);
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

    //creating function for getting all values anywhere in ms
    public static function getvalueall($slug_id) {

        Log::info('In 28-07-2021 ProjectApiController->getvalueall()');
        try {
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL . SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL: ' . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL'));
            Log::info('Calling ProjectApiController->getTaskBoardAccessToken()');
            $access_token = ProjectApiController::getTaskBoardAccessToken();
            Log::info('Got the access token from ProjectApiController->getTaskBoardAccessToken(). Now fetching courses!'.$access_token);
            $http = new Client(); //GuzzleHttp\Client
            $response = $http->get(
                 Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL') . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL').'/'.$slug_id,
                
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
