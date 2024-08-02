<?php

// Include the Google API client library
require_once 'vendor/autoload.php';

// init config
$clientID = '971308071057-qu8a0np2rlocrdl1l5k80pep4gilifte.apps.googleusercontent.com';
$clientSecret = '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';
$redirectURL = 'http://localhost/kict-project/google-dashboard.php';

// Set up the Google client
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURL);
$client->addScope('email');
$client->addScope('profile');

session_start();
// Database connection details
$servername = "localhost";
$username = "admin";
$password = "6680Afa.";
$database = "Myshop";

//Create connection
$conn = new mysqli($servername, $username, $password, $database);

//Check connection     
if (!$conn) {
    die(mysqli_error($conn));
}

?>