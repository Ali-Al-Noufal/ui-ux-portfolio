<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

'paths' => ['api/*', 'sanctum/csrf-cookie'],

'allowed_methods' => ['*'],

// أضف رابط الـ React الخاص بك هنا بدقة
'allowed_origins' => [
    'https://alaamohammad.vercel.app',
],

'allowed_origins_patterns' => [],

'allowed_headers' => ['*'],

'exposed_headers' => [],

'max_age' => 0,

'supports_credentials' => true, // اجعلها true إذا كنت تستخدم ملفات تعريف الارتباط أو Sanctum

];
