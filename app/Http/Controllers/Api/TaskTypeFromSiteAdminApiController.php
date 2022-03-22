<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use GuzzleHttp\Client as Client;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Auth;
use Config;
use Validator;

class TaskTypeFromSiteAdminApiController extends Controller
{
    

    private static function getSiteAdminTaskTypeAccessToken()
    {
        Log::info('In TaskTypeFromSiteAdminApiController->getSiteAdminTaskTypeAccessToken()');
        try{
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL:' . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL'));
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
                        'client_id' => Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_CLIENT_ID'),
                        'client_secret' => Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_SECRET'),
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
            Log::info('There is some exception in TaskTypeFromSiteAdminApiController->getSiteAdminTaskTypeAccessToken()');
            return $e->getResponse()->getStatusCode() . ': ' . $e->getMessage();
        }
    }

    //get project function
    public function getValueAllSiteAdmin($slug_id)
    {
        
        try{
            Log::info('SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL: ' . Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL'));
            $access_token = $this->getSiteAdminTaskTypeAccessToken();
            $url = ''
            .Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL')
            .Config::get('app.SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL')
            .'/'
            .$slug_id;
            Log::info('Got the access token from TaskTypeFromSiteAdminApiController::getSiteAdminTaskTypeAccessToken(). Now fetching User!');
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
            Log::info('There was some exception in TaskTypeFromSiteAdminApiController->getProject()');
            return $e->getResponse()->getStatusCode(). ':' . $e->getMessage();
        }
    }

}