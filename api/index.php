<?php

// 1. تهيئة المجلدات الضرورية في المجلد المؤقت
$tempStorage = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache'
];

foreach ($tempStorage as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

// 2. إخبار لارافيل أين يضع ملفات الكاش الجديدة بدلاً من المجلد المحمي
putenv('APP_CONFIG_CACHE=/tmp/bootstrap/cache/config.php');
putenv('APP_ROUTES_CACHE=/tmp/bootstrap/cache/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/bootstrap/cache/services.php');
putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/cache/packages.php');

// 3. استدعاء ملف التشغيل الأصلي
require __DIR__ . '/../public/index.php';