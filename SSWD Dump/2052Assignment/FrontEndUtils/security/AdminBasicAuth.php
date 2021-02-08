<?php
//requires basic auth details to be suppied to access the api
//this file is included in the api pages 
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="admin Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'API available to authorized users only';
    exit;
} else {
    if (($_SERVER['PHP_AUTH_USER'] != 'adminuser') || ($_SERVER['PHP_AUTH_PW'] != "adminpass")) {

        header('WWW-Authenticate: Basic realm="admin Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'API available to authorized users only';
        exit;
    }
}
