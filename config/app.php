<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environmentf
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    // Admin all api url from .env

    'SD_ORGANISATION_TYPE_MS_BASE_URL'=> env('SD_ORGANISATION_TYPE_MS_BASE_URL','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_OAUTH_TOKEN_URL'=> env('SD_ORGANISATION_TYPE_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_GRAND_TYPE'=> env('SD_ORGANISATION_TYPE_MS_GRAND_TYPE','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_CLIENT_ID'=> env('SD_ORGANISATION_TYPE_MS_CLIENT_ID','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_SECRET'=> env('SD_ORGANISATION_TYPE_MS_SECRET','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_ALL_URL'=> env('SD_ORGANISATION_TYPE_MS_ALL_URL','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_STORE_URL'=> env('SD_ORGANISATION_TYPE_MS_STORE_URL','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_EDIT'=> env('SD_ORGANISATION_TYPE_MS_EDIT','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_UPDATE' =>env('SD_ORGANISATION_TYPE_MS_UPDATE','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_DELETE_URL'=> env('SD_ORGANISATION_TYPE_MS_DELETE_URL','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_DASHBOARD_URL'=> env('SD_ORGANISATION_TYPE_MS_DASHBOARD_URL','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_STORE_ROLE_ORG_NAME_URL'=> env('SD_ORGANISATION_TYPE_MS_STORE_ROLE_ORG_NAME_URL','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_AFTER_INVITE_GET_USER_ALL_URL'=> env('SD_ORGANISATION_TYPE_MS_AFTER_INVITE_GET_USER_ALL_URL','not found in .env file'),
    'SD_ORGANISATION_TYPE_MS_INVITED_USER_REGISTER_STORE_URL'=> env('SD_ORGANISATION_TYPE_MS_INVITED_USER_REGISTER_STORE_URL','not found in .env file'),
    
    'SD_ADMIN_MS_BASE_URL'=> env('SD_ADMIN_MS_BASE_URL','not found in .env file'),
    'SD_ADMIN_MS_OAUTH_TOKEN_URL'=> env('SD_ADMIN_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_ADMIN_MS_GRAND_TYPE'=> env('SD_ADMIN_MS_GRAND_TYPE','not found in .env file'),
    'SD_ADMIN_MS_CLIENT_ID'=> env('SD_ADMIN_MS_CLIENT_ID','not found in .env file'),
    'SD_ADMIN_MS_SECRET'=> env('SD_ADMIN_MS_SECRET','not found in .env file'),
    'SD_ADMIN_MS_ALL_URL'=> env('SD_ADMIN_MS_ALL_URL','not found in .env file'),
    'SD_ADMIN_MS_STORE_URL'=> env('SD_ADMIN_MS_STORE_URL','not found in .env file'),
    'SD_ADMIN_MS_EDIT'=> env('SD_ADMIN_MS_EDIT','not found in .env file'),
    'SD_ADMIN_MS_UPDATE' =>env('SD_ADMIN_MS_UPDATE','not found in .env file'),
    'SD_ADMIN_MS_DELETE_URL'=> env('SD_ADMIN_MS_DELETE_URL','not found in .env file'),

    // Manager all Api url from .env
    'SD_MANAGER_MS_BASE_URL'=> env('SD_MANAGER_MS_BASE_URL','not found in .env file'),
    'SD_MANAGER_MS_OAUTH_TOKEN_URL'=> env('SD_MANAGER_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_MANAGER_MS_GRAND_TYPE'=> env('SD_MANAGER_MS_GRAND_TYPE','not found in .env file'),
    'SD_MANAGER_MS_CLIENT_ID'=> env('SD_MANAGER_MS_CLIENT_ID','not found in .env file'),
    'SD_MANAGER_MS_SECRET'=> env('SD_MANAGER_MS_SECRET','not found in .env file'),
    'SD_MANAGER_MS_ALL_URL'=> env('SD_MANAGER_MS_ALL_URL','not found in .env file'),
    'SD_MANAGER_MS_STORE_URL'=> env('SD_MANAGER_MS_STORE_URL','not found in .env file'),
    'SD_MANAGER_MS_EDIT'=> env('SD_MANAGER_MS_EDIT','not found in .env file'),
    'SD_MANAGER_MS_UPDATE' =>env('SD_MANAGER_MS_UPDATE','not found in .env file'),
    'SD_MANAGER_MS_DELETE_URL'=> env('SD_MANAGER_MS_DELETE_URL','not found in .env file'),

    // task type value is comming from SiteAdmin open
    'SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL'=> env('SD_TASK_TYPE_SITE_ADMIN_MS_BASE_URL','not found in .env file'),
    'SD_TASK_TYPE_SITE_ADMIN_MS_OAUTH_TOKEN_URL'=> env('SD_TASK_TYPE_SITE_ADMIN_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_TASK_TYPE_SITE_ADMIN_MS_GRAND_TYPE'=> env('SD_TASK_TYPE_SITE_ADMIN_MS_GRAND_TYPE','not found in .env file'),
    'SD_TASK_TYPE_SITE_ADMIN_MS_CLIENT_ID'=> env('SD_TASK_TYPE_SITE_ADMIN_MS_CLIENT_ID','not found in .env file'),
    'SD_TASK_TYPE_SITE_ADMIN_MS_SECRET'=> env('SD_TASK_TYPE_SITE_ADMIN_MS_SECRET','not found in .env file'),
    'SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL'=> env('SD_TASK_TYPE_SITE_ADMIN_MS_ALL_URL','not found in .env file'),
    // task type value is comming from SiteAdmin close
    // Task Type all Api url from .env
    'SD_TASK_TYPE_MS_BASE_URL'=> env('SD_TASK_TYPE_MS_BASE_URL','not found in .env file'),
    'SD_TASK_TYPE_MS_OAUTH_TOKEN_URL'=> env('SD_TASK_TYPE_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_TASK_TYPE_MS_GRAND_TYPE'=> env('SD_TASK_TYPE_MS_GRAND_TYPE','not found in .env file'),
    'SD_TASK_TYPE_MS_CLIENT_ID'=> env('SD_TASK_TYPE_MS_CLIENT_ID','not found in .env file'),
    'SD_TASK_TYPE_MS_SECRET'=> env('SD_TASK_TYPE_MS_SECRET','not found in .env file'),
    'SD_TASK_TYPE_MS_ALL_URL'=> env('SD_TASK_TYPE_MS_ALL_URL','not found in .env file'),
    'SD_TASK_TYPE_MS_STORE_URL'=> env('SD_TASK_TYPE_MS_STORE_URL','not found in .env file'),
    'SD_TASK_TYPE_MS_EDIT'=> env('SD_TASK_TYPE_MS_EDIT','not found in .env file'),
    'SD_TASK_TYPE_MS_UPDATE' =>env('SD_TASK_TYPE_MS_UPDATE','not found in .env file'),
    'SD_TASK_TYPE_MS_DELETE_URL'=> env('SD_TASK_TYPE_MS_DELETE_URL','not found in .env file'),

    // Project All Api URL from .env
    'SD_PROJECTS_MS_BASE_URL'=> env('SD_PROJECTS_MS_BASE_URL','not found in .env file'),
    'SD_PROJECTS_MS_OAUTH_TOKEN_URL'=> env('SD_PROJECTS_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_PROJECTS_MS_GRAND_TYPE'=> env('SD_PROJECTS_MS_GRAND_TYPE','not found in .env file'),
    'SD_PROJECTS_MS_CLIENT_ID'=> env('SD_PROJECTS_MS_CLIENT_ID','not found in .env file'),
    'SD_PROJECTS_MS_SECRET'=> env('SD_PROJECTS_MS_SECRET','not found in .env file'),
    'SD_PROJECTS_MS_ALL_URL'=> env('SD_PROJECTS_MS_ALL_URL','not found in .env file'),
    'SD_PROJECTS_MS_STORE_URL'=> env('SD_PROJECTS_MS_STORE_URL','not found in .env file'),
    'SD_PROJECTS_MS_EDIT'=> env('SD_PROJECTS_MS_EDIT','not found in .env file'),
    'SD_PROJECTS_MS_UPDATE' =>env('SD_PROJECTS_MS_UPDATE','not found in .env file'),
    'SD_PROJECTS_MS_DELETE_URL'=> env('SD_PROJECTS_MS_DELETE_URL','not found in .env file'),

    // Users Manager api URL from .env
    'SD_USERS_MANAGER_MS_BASE_URL'=> env('SD_USERS_MANAGER_MS_BASE_URL','not found in .env file'),
    'SD_USERS_MANAGER_MS_OAUTH_TOKEN_URL'=> env('SD_USERS_MANAGER_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_USERS_MANAGER_MS_GRAND_TYPE'=> env('SD_USERS_MANAGER_MS_GRAND_TYPE','not found in .env file'),
    'SD_USERS_MANAGER_MS_CLIENT_ID'=> env('SD_USERS_MANAGER_MS_CLIENT_ID','not found in .env file'),
    'SD_USERS_MANAGER_MS_SECRET'=> env('SD_USERS_MANAGER_MS_SECRET','not found in .env file'),
    'SD_USERS_MANAGER_MS_ALL_URL'=> env('SD_USERS_MANAGER_MS_ALL_URL','not found in .env file'),
    'SD_USERS_MANAGER_MS_STORE_URL'=> env('SD_USERS_MANAGER_MS_STORE_URL','not found in .env file'),
    'SD_USERS_MANAGER_MS_EDIT'=> env('SD_USERS_MANAGER_MS_EDIT','not found in .env file'),
    'SD_USERS_MANAGER_MS_UPDATE' =>env('SD_USERS_MANAGER_MS_UPDATE','not found in .env file'),
    'SD_USERS_MANAGER_MS_DELETE_URL'=> env('SD_USERS_MANAGER_MS_DELETE_URL','not found in .env file'),

    // User Api URL from .env
    'SD_USER_MS_BASE_URL'=> env('SD_USER_MS_BASE_URL','not found in .env file'),
    'SD_USER_MS_OAUTH_TOKEN_URL'=> env('SD_USER_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_USER_MS_GRAND_TYPE'=> env('SD_USER_MS_GRAND_TYPE','not found in .env file'),
    'SD_USER_MS_CLIENT_ID'=> env('SD_USER_MS_CLIENT_ID','not found in .env file'),
    'SD_USER_MS_SECRET'=> env('SD_USER_MS_SECRET','not found in .env file'),
    'SD_USER_MS_ALL_URL'=> env('SD_USER_MS_ALL_URL','not found in .env file'),
    'SD_USER_MS_STORE_URL'=> env('SD_USER_MS_STORE_URL','not found in .env file'),
    'SD_USER_MS_EDIT'=> env('SD_USER_MS_EDIT','not found in .env file'),
    'SD_USER_MS_UPDATE' =>env('SD_USER_MS_UPDATE','not found in .env file'),
    'SD_USER_MS_DELETE_URL'=> env('SD_USER_MS_DELETE_URL','not found in .env file'),

    // ADD URLs Api from .env
    'SD_ADD_URLS_MS_BASE_URL'=> env('SD_ADD_URLS_MS_BASE_URL','not found in .env file'),
    'SD_ADD_URLS_MS_OAUTH_TOKEN_URL'=> env('SD_ADD_URLS_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_ADD_URLS_MS_GRAND_TYPE'=> env('SD_ADD_URLS_MS_GRAND_TYPE','not found in .env file'),
    'SD_ADD_URLS_MS_CLIENT_ID'=> env('SD_ADD_URLS_MS_CLIENT_ID','not found in .env file'),
    'SD_ADD_URLS_MS_SECRET'=> env('SD_ADD_URLS_MS_SECRET','not found in .env file'),
    'SD_ADD_URLS_MS_ALL_URL'=> env('SD_ADD_URLS_MS_ALL_URL','not found in .env file'),
    'SD_ADD_URLS_MS_STORE_URL'=> env('SD_ADD_URLS_MS_STORE_URL','not found in .env file'),
    'SD_ADD_URLS_MS_EDIT'=> env('SD_ADD_URLS_MS_EDIT','not found in .env file'),
    'SD_ADD_URLS_MS_UPDATE' =>env('SD_ADD_URLS_MS_UPDATE','not found in .env file'),
    'SD_ADD_URLS_MS_DELETE_URL'=> env('SD_ADD_URLS_MS_DELETE_URL','not found in .env file'),
    'SD_ADD_URLS_MS_GETPROJECT_URL'=> env('SD_ADD_URLS_MS_GETPROJECT_URL','not found in .env file'),

    // Keyword api from .env
    'SD_KEYWORDS_MS_BASE_URL'=> env('SD_KEYWORDS_MS_BASE_URL','not found in .env file'),
    'SD_KEYWORDS_MS_OAUTH_TOKEN_URL'=> env('SD_KEYWORDS_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_KEYWORDS_MS_GRAND_TYPE'=> env('SD_KEYWORDS_MS_GRAND_TYPE','not found in .env file'),
    'SD_KEYWORDS_MS_CLIENT_ID'=> env('SD_KEYWORDS_MS_CLIENT_ID','not found in .env file'),
    'SD_KEYWORDS_MS_SECRET'=> env('SD_KEYWORDS_MS_SECRET','not found in .env file'),
    'SD_KEYWORDS_MS_ALL_URL'=> env('SD_KEYWORDS_MS_ALL_URL','not found in .env file'),
    'SD_KEYWORDS_MS_STORE_URL'=> env('SD_KEYWORDS_MS_STORE_URL','not found in .env file'),
    'SD_KEYWORDS_MS_EDIT'=> env('SD_KEYWORDS_MS_EDIT','not found in .env file'),
    'SD_KEYWORDS_MS_UPDATE' =>env('SD_KEYWORDS_MS_UPDATE','not found in .env file'),
    'SD_KEYWORDS_MS_DELETE_URL'=> env('SD_KEYWORDS_MS_DELETE_URL','not found in .env file'),
    'SD_KEYWORDS_MS_GETKEYWORD_URL'=> env('SD_KEYWORDS_MS_GETKEYWORD_URL','not found in .env file'),

    // Rating api from .env
    'SD_TEAM_RATING_MS_BASE_URL'=> env('SD_TEAM_RATING_MS_BASE_URL','not found in .env file'),
    'SD_TEAM_RATING_MS_OAUTH_TOKEN_URL'=> env('SD_TEAM_RATING_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_TEAM_RATING_MS_GRAND_TYPE'=> env('SD_TEAM_RATING_MS_GRAND_TYPE','not found in .env file'),
    'SD_TEAM_RATING_MS_CLIENT_ID'=> env('SD_TEAM_RATING_MS_CLIENT_ID','not found in .env file'),
    'SD_TEAM_RATING_MS_SECRET'=> env('SD_TEAM_RATING_MS_SECRET','not found in .env file'),
    'SD_TEAM_RATING_MS_ALL_URL'=> env('SD_TEAM_RATING_MS_ALL_URL','not found in .env file'),
    'SD_TEAM_RATING_MS_STORE_URL'=> env('SD_TEAM_RATING_MS_STORE_URL','not found in .env file'),
    'SD_TEAM_RATING_MS_EDIT'=> env('SD_TEAM_RATING_MS_EDIT','not found in .env file'),
    'SD_TEAM_RATING_MS_UPDATE' =>env('SD_TEAM_RATING_MS_UPDATE','not found in .env file'),
    'SD_TEAM_RATING_MS_DELETE_URL'=> env('SD_TEAM_RATING_MS_DELETE_URL','not found in .env file'),

    // Website Ranking api from .env
    'SD_WEBSITE_RANKING_MS_BASE_URL'=> env('SD_WEBSITE_RANKING_MS_BASE_URL','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_OAUTH_TOKEN_URL'=> env('SD_WEBSITE_RANKING_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_GRAND_TYPE'=> env('SD_WEBSITE_RANKING_MS_GRAND_TYPE','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_CLIENT_ID'=> env('SD_WEBSITE_RANKING_MS_CLIENT_ID','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_SECRET'=> env('SD_WEBSITE_RANKING_MS_SECRET','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_ALL_URL'=> env('SD_WEBSITE_RANKING_MS_ALL_URL','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_STORE_URL'=> env('SD_WEBSITE_RANKING_MS_STORE_URL','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_DELETE_URL'=> env('SD_WEBSITE_RANKING_MS_DELETE_URL','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_EDIT'=> env('SD_WEBSITE_RANKING_MS_EDIT','not found in .env file'),
    'SD_WEBSITE_RANKING_MS_UPDATE' =>env('SD_WEBSITE_RANKING_MS_UPDATE','not found in .env file'),

    // Page Ranking api from .env
    'SD_PAGE_RANKING_MS_BASE_URL'=> env('SD_PAGE_RANKING_MS_BASE_URL','not found in .env file'),
    'SD_PAGE_RANKING_MS_OAUTH_TOKEN_URL'=> env('SD_PAGE_RANKING_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_PAGE_RANKING_MS_GRAND_TYPE'=> env('SD_PAGE_RANKING_MS_GRAND_TYPE','not found in .env file'),
    'SD_PAGE_RANKING_MS_CLIENT_ID'=> env('SD_PAGE_RANKING_MS_CLIENT_ID','not found in .env file'),
    'SD_PAGE_RANKING_MS_SECRET'=> env('SD_PAGE_RANKING_MS_SECRET','not found in .env file'),
    'SD_PAGE_RANKING_MS_ALL_URL'=> env('SD_PAGE_RANKING_MS_ALL_URL','not found in .env file'),
    'SD_PAGE_RANKING_MS_STORE_URL'=> env('SD_PAGE_RANKING_MS_STORE_URL','not found in .env file'),
    'SD_PAGE_RANKING_MS_EDIT'=> env('SD_PAGE_RANKING_MS_EDIT','not found in .env file'),
    'SD_PAGE_RANKING_MS_UPDATE' =>env('SD_PAGE_RANKING_MS_UPDATE','not found in .env file'),
    'SD_PAGE_RANKING_MS_DELETE_URL'=> env('SD_PAGE_RANKING_MS_DELETE_URL','not found in .env file'),

    // Social Ranking api from .env
    'SD_SOCIAL_RANKING_MS_BASE_URL'=> env('SD_SOCIAL_RANKING_MS_BASE_URL','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_OAUTH_TOKEN_URL'=> env('SD_SOCIAL_RANKING_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_GRAND_TYPE'=> env('SD_SOCIAL_RANKING_MS_GRAND_TYPE','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_CLIENT_ID'=> env('SD_SOCIAL_RANKING_MS_CLIENT_ID','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_SECRET'=> env('SD_SOCIAL_RANKING_MS_SECRET','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_ALL_URL'=> env('SD_SOCIAL_RANKING_MS_ALL_URL','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_STORE_URL'=> env('SD_SOCIAL_RANKING_MS_STORE_URL','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_EDIT'=> env('SD_SOCIAL_RANKING_MS_EDIT','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_UPDATE' =>env('SD_SOCIAL_RANKING_MS_UPDATE','not found in .env file'),
    'SD_SOCIAL_RANKING_MS_DELETE_URL'=> env('SD_SOCIAL_RANKING_MS_DELETE_URL','not found in .env file'),

    // webiste access api from .env
    'SD_WEBSITE_ACCESS_MS_BASE_URL'=> env('SD_WEBSITE_ACCESS_MS_BASE_URL','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_OAUTH_TOKEN_URL'=> env('SD_WEBSITE_ACCESS_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_GRAND_TYPE'=> env('SD_WEBSITE_ACCESS_MS_GRAND_TYPE','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_CLIENT_ID'=> env('SD_WEBSITE_ACCESS_MS_CLIENT_ID','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_SECRET'=> env('SD_WEBSITE_ACCESS_MS_SECRET','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_ALL_URL'=> env('SD_WEBSITE_ACCESS_MS_ALL_URL','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_STORE_URL'=> env('SD_WEBSITE_ACCESS_MS_STORE_URL','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_EDIT'=> env('SD_WEBSITE_ACCESS_MS_EDIT','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_UPDATE' =>env('SD_WEBSITE_ACCESS_MS_UPDATE','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_DELETE_URL'=> env('SD_WEBSITE_ACCESS_MS_DELETE_URL','not found in .env file'),
    'SD_WEBSITE_ACCESS_MS_DECRYPT_ENCRYPT'=> env('SD_WEBSITE_ACCESS_MS_DECRYPT_ENCRYPT','not found in .env file'),

    // email access api from .env
    'SD_EMAIL_MS_BASE_URL' => env('SD_EMAIL_MS_BASE_URL','not found in .env'),
    'SD_EMAIL_MS_OAUTH_TOKEN_URL' => env('SD_EMAIL_MS_OAUTH_TOKEN_URL','not found in .env'),
    'SD_EMAIL_MS_GRAND_TYPE' => env('SD_EMAIL_MS_GRAND_TYPE','not found in .env'),
    'SD_EMAIL_MS_CLIENT_ID' => env('SD_EMAIL_MS_CLIENT_ID','not found in .env'),
    'SD_EMAIL_MS_SECRET' => env('SD_EMAIL_MS_SECRET','not found in .env'),
    'SD_EMAIL_MS_ALL_URL' => env('SD_EMAIL_MS_ALL_URL','not found in .env'),
    'SD_EMAIL_MS_STORE_URL' => env('SD_EMAIL_MS_STORE_URL','not found in .env'),
    'SD_EMAIL_MS_DELETE_URL' => env('SD_EMAIL_MS_DELETE_URL','not found in .env'),
    'SD_EMAIL_MS_EDIT' => env('SD_EMAIL_MS_EDIT','not found in .env'),
    'SD_EMAIL_MS_UPDATE' => env('SD_EMAIL_MS_UPDATE','not found in .env'),

    // phone number api from .env
    'SD_PHONE_NUMBER_MS_BASE_URL' => env('SD_PHONE_NUMBER_MS_BASE_URL','not found in .env'),
    'SD_PHONE_NUMBER_MS_OAUTH_TOKEN_URL' => env('SD_PHONE_NUMBER_MS_OAUTH_TOKEN_URL','not found in .env'),
    'SD_PHONE_NUMBER_MS_GRAND_TYPE' => env('SD_PHONE_NUMBER_MS_GRAND_TYPE','not found in .env'),
    'SD_PHONE_NUMBER_MS_CLIENT_ID' => env('SD_PHONE_NUMBER_MS_CLIENT_ID','not found in .env'),
    'SD_PHONE_NUMBER_MS_SECRET' => env('SD_PHONE_NUMBER_MS_SECRET','not found in .env'),
    'SD_PHONE_NUMBER_MS_ALL_URL' => env('SD_PHONE_NUMBER_MS_ALL_URL','not found in .env'),
    'SD_PHONE_NUMBER_MS_STORE_URL' => env('SD_PHONE_NUMBER_MS_STORE_URL','not found in .env'),
    'SD_PHONE_NUMBER_MS_DELETE_URL' => env('SD_PHONE_NUMBER_MS_DELETE_URL','not found in .env'),
    'SD_PHONE_NUMBER_MS_EDIT' => env('SD_PHONE_NUMBER_MS_EDIT','not found in .env'),
    'SD_PHONE_NUMBER_MS_UPDATE' => env('SD_PHONE_NUMBER_MS_UPDATE','not found in .env'),

    // Task Board  api from .env
    'SD_TASK_BOARD_MS_BASE_URL'=> env('SD_TASK_BOARD_MS_BASE_URL','not found in .env file'),
    'SD_TASK_BOARD_MS_OAUTH_TOKEN_URL'=> env('SD_TASK_BOARD_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_TASK_BOARD_MS_GRAND_TYPE'=> env('SD_TASK_BOARD_MS_GRAND_TYPE','not found in .env file'),
    'SD_TASK_BOARD_MS_CLIENT_ID'=> env('SD_TASK_BOARD_MS_CLIENT_ID','not found in .env file'),
    'SD_TASK_BOARD_MS_SECRET'=> env('SD_TASK_BOARD_MS_SECRET','not found in .env file'),
    'SD_TASK_BOARD_MS_ALL_URL'=> env('SD_TASK_BOARD_MS_ALL_URL','not found in .env file'),
    'SD_TASK_BOARD_MS_STORE_URL'=> env('SD_TASK_BOARD_MS_STORE_URL','not found in .env file'),
    'SD_TASK_BOARD_MS_EDIT'=> env('SD_TASK_BOARD_MS_EDIT','not found in .env file'),
    'SD_TASK_BOARD_MS_UPDATE'=> env('SD_TASK_BOARD_MS_UPDATE','not found in .env file'),
    'SD_TASK_BOARD_MS_DELETE_URL' =>env('SD_TASK_BOARD_MS_DELETE_URL','not found in .env file'),

    // Interval Task Api from .env
    'SD_INTERVAL_TASK_MS_BASE_URL' => env('SD_INTERVAL_TASK_MS_BASE_URL','not found in .env'),
    'SD_INTERVAL_TASK_MS_OAUTH_TOKEN_URL' => env('SD_INTERVAL_TASK_MS_OAUTH_TOKEN_URL','not found in .env'),
    'SD_INTERVAL_TASK_MS_GRAND_TYPE' => env('SD_INTERVAL_TASK_MS_GRAND_TYPE','not found in .env'),
    'SD_INTERVAL_TASK_MS_CLIENT_ID' => env('SD_INTERVAL_TASK_MS_CLIENT_ID','not found in .env'),
    'SD_INTERVAL_TASK_MS_SECRET' => env('SD_INTERVAL_TASK_MS_SECRET','not found in .env'),
    'SD_INTERVAL_TASK_MS_ALL_URL' => env('SD_INTERVAL_TASK_MS_ALL_URL','not found in .env'),
    'SD_INTERVAL_TASK_MS_STORE_URL' => env('SD_INTERVAL_TASK_MS_STORE_URL','not found in .env'),
    'SD_INTERVAL_TASK_MS_DELETE_URL' => env('SD_INTERVAL_TASK_MS_DELETE_URL','not found in .env'),
    'SD_INTERVAL_TASK_MS_EDIT' => env('SD_INTERVAL_TASK_MS_EDIT','not found in .env'),
    'SD_INTERVAL_TASK_MS_UPDATE' => env('SD_INTERVAL_TASK_MS_UPDATE','not found in .env'),

    ##############################################################################
    ## site admin
    'SD_SUPER_ADMIN_MS_BASE_URL'=> env('SD_SUPER_ADMIN_MS_BASE_URL','not found in .env file'),
    'SD_SUPER_ADMIN_MS_OAUTH_TOKEN_URL'=> env('SD_SUPER_ADMIN_MS_OAUTH_TOKEN_URL','not found in .env file'),
    'SD_SUPER_ADMIN_MS_GRAND_TYPE'=> env('SD_SUPER_ADMIN_MS_GRAND_TYPE','not found in .env file'),
    'SD_SUPER_ADMIN_MS_CLIENT_ID'=> env('SD_SUPER_ADMIN_MS_CLIENT_ID','not found in .env file'),
    'SD_SUPER_ADMIN_MS_TYPE_SECRET'=> env('SD_SUPER_ADMIN_MS_TYPE_SECRET','not found in .env file'),
    'SD_SUPER_ADMIN_ALL_URL'=> env('SD_SUPER_ADMIN_ALL_URL','not found in .env file'),
    'SD_SUPER_ADMIN_STORE_URL'=> env('SD_SUPER_ADMIN_STORE_URL','not found in .env file'),
    'SD_SUPER_ADMIN_EDIT'=> env('SD_SUPER_ADMIN_EDIT','not found in .env file'),
    'SD_SUPER_ADMIN_UPDATE' =>env('SD_SUPER_ADMIN_UPDATE','not found in .env file'),
    'SD_SUPER_ADMIN_DELETE_URL'=> env('SD_SUPER_ADMIN_DELETE_URL','not found in .env file'),
    ########################################################################################################

   ## wizard-projects
   'SD_WIZARD_PROJECT_MS_BASE_URL'=> env('SD_WIZARD_PROJECT_MS_BASE_URL','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_OAUTH_TOKEN_URL'=> env('SD_WIZARD_PROJECT_MS_OAUTH_TOKEN_URL','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_GRAND_TYPE'=> env('SD_WIZARD_PROJECT_MS_GRAND_TYPE','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_CLIENT_ID'=> env('SD_WIZARD_PROJECT_MS_CLIENT_ID','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_SECRET'=> env('SD_WIZARD_PROJECT_MS_SECRET','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_ALL_URL'=> env('SD_WIZARD_PROJECT_MS_ALL_URL','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_STORE_URL'=> env('SD_WIZARD_PROJECT_MS_STORE_URL','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_EDIT' =>env('SD_WIZARD_PROJECT_MS_EDIT','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_UPDATE'=> env('SD_WIZARD_PROJECT_MS_UPDATE','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_DELETE_URL'=> env('SD_WIZARD_PROJECT_MS_DELETE_URL','not found in .env file'),
   'SD_WIZARD_PROJECT_MS_GETPROJECT_URL'=> env('SD_WIZARD_PROJECT_MS_GETPROJECT_URL','not found in .env file'),




    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,
        // Laravel\Socialite\SocialiteServiceProvider::class,

        /*
         * Package Service Providers...
         */
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Laravel\Passport\PassportServiceProvider::class,
        Anhskohbo\NoCaptcha\NoCaptchaServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Arr' => Illuminate\Support\Arr::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'Str' => Illuminate\Support\Str::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        // 'Toastr'  => Brian2694\Toastr\Facades\Toastr::class,
        // 'socialite' => Laravel\Socialite\Facades\Socialite::class,

    ],

];
