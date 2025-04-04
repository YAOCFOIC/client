<?php

// Database constants
define('DB_HOST', 'localhost');
define('DB_NAME', 'compras_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Path constants
define('APP_PATH', realpath(__DIR__ . '/../app-client'));
define('VIEW_PATH', APP_PATH . '/views/');
define('BASE_URL', '/client/public');

define('SESSION_TIMEOUT', 1800); // 30 minutos

?>