<?php
//requires basic auth details to be supplied to access the api
//this file is included in the api pages 
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="REST Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'API available to authorized users only';
    exit;
} else {
    if (($_SERVER['PHP_AUTH_USER'] != 'apiuser') || ($_SERVER['PHP_AUTH_PW'] != "apipass")) {

        header('WWW-Authenticate: Basic realm="REST Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'API available to authorized users only';
        exit;
    }
}
