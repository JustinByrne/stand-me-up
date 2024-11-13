<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | This is the API key from clockify found within the user profile section
    |
    */

    'api_key' => env('CLOCKIFY_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | API URL
    |--------------------------------------------------------------------------
    |
    | This is the url to access the api
    |
    */

    'url' => env('CLOCKIFY_API_URL'),

    /*
    |--------------------------------------------------------------------------
    | Workspace id
    |--------------------------------------------------------------------------
    |
    | This is the id of the workspace
    |
    */

    'workspace_id' => env('CLOCKIFY_WORKSPACE_ID'),

    /*
    |--------------------------------------------------------------------------
    | User id
    |--------------------------------------------------------------------------
    |
    | This is the id of the user
    |
    */

    'user_id' => env('CLOCKIFY_USER_ID'),

    /*
    |--------------------------------------------------------------------------
    | Testing tasks
    |--------------------------------------------------------------------------
    |
    | This is an array of testing task types, this is from a comma seperated
    | list.
    |
    */

    'testing_tasks' => explode(',', env('CLOCKIFY_TESTING_TASKS', 'testing')),

    /*
    |--------------------------------------------------------------------------
    | Reviewing tasks
    |--------------------------------------------------------------------------
    |
    | This is an array of reviewing task types, this is from a comma seperated
    | list.
    |
    */

    'reviewing_tasks' => explode(',', env('CLOCKIFY_REVIEWING_TASKS', 'pr review')),

];
