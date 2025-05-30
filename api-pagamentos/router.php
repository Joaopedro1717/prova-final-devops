<?php
// Se o arquivo físico existir, serve normalmente
if (php_sapi_name() === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) {
        return false; // serve o arquivo diretamente
    }
}

// Senão, encaminha tudo para o index.php
require_once __DIR__ . '/index.php';
