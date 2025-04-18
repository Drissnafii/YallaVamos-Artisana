<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Gemini API Configuration
    |--------------------------------------------------------------------------
    |
    | This file stores configuration settings for accessing the Google
    | Gemini API. The API key is loaded from the .env file for security.
    |
    */

    'api_key' => env('GEMINI_API_KEY', null), // Use null as default if not set

    // You could add other Gemini-related settings here if needed
    // 'model' => env('GEMINI_MODEL', 'gemini-pro'),

];
