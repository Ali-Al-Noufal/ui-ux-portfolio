<?php

// إنشاء المجلدات اللازمة في البيئة المؤقتة لتجنب خطأ Read-only
mkdir('/tmp/storage/framework/views', 0755, true);
mkdir('/tmp/storage/framework/cache', 0755, true);
mkdir('/tmp/storage/framework/sessions', 0755, true);
mkdir('/tmp/storage/logs', 0755, true);
mkdir('/tmp/bootstrap/cache', 0755, true);

require __DIR__ . '/../public/index.php';