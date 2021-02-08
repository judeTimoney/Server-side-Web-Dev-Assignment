<?php
//credentials for accessing database
$passw = "t25qHzYB0s83BFQk";

$username = "jtimoney03";

$db = "jtimoney03";

$host = "jtimoney03.sites.eeecs.qub.ac.uk";

ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli($host, $username, $passw, $db);

if ($conn->connect_error) {
    echo "not connected" . $conn->connect_error;
} else {
    // echo "connection to DB found.";
}
