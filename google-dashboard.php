<?php

include './db/config.php';

//     //         use GuzzleHttp\Client;
//     // // Specify the path to the downloaded CA bundle file
//     // $caBundlePath = 'C:\php-8.2.13\curl_files';

//     // // Create a GuzzleHttp client with the specified CA bundle path
//     // $client = new Client(['verify' => $caBundlePath]);

//     // $client = new GuzzleHttp\Client([
//     //     'proxy' => 'http://192.168.137.214:80',
//     //     'timeout' => 300,
//     // ]);

//      // Include the Composer autoloader
// require '/var/www/html/kict-project/vendor/autoload.php';

// use GuzzleHttp\Client;

// // Create a new Guzzle client instance
// $client = new Client();

// // Specify the URL you want to send the request to
// $url = 'http://localhost/kict-project/google-dashboard.php';

// try {
//     // Send a GET request to the specified URL
//     $response = $client->get($url);

//     // Get the response body as a string
//     $body = $response->getBody()->getContents();

//     // Output the response body
//     echo $body;
// } catch (GuzzleHttp\Exception\GuzzleException $e) {
//     // Handle exceptions such as connection errors or server errors
//     echo 'Error: ' . $e->getMessage();
// }



//    authenticate code from google oauth flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get(); // Corrected method name
    $userInfo = [
        // 'Username' => $google_account_info->getName(), // Use getName() method
        'Image' => $google_account_info->getPicture(), // Use getPicture() method
        'VerifiedEmail' => $google_account_info->getVerifiedEmail(), // Use getVerifiedEmail() method
        'Token' => $google_account_info->getId(), // Use getId() method
    ];


    // checking if user is already exist in database 
    $sql = "SELECT * FROM `sign_database` WHERE Email = '{$userInfo['email']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // User is exist
        $userInfo = mysqli_fetch_assoc($result);
        $token = $userInfo['Token'];
    } else {
        // User is not exist
        $sql = "INSERT INTO `sign_database` (Email, Username, Password, Image, VerifiedEmail, Token) VALUES ('{$userInfo['Email']}', 
        '{$userInfo['Username']}', '{$userInfo['Password']}', '{$userInfo['Image']}', '{$userInfo['VerifiedEmail']}',
        '{$userInfo['Token']}'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $token = $userInfo['Token'];
        } else {
            echo "User is not created";
            die();
        }
    }

    // save user data into session
    $_SESSION["user_token"] = $token;
} else {
    if (!isset($_SESSION['user_token'])) {
        header("Location: index.php");
        die();
    }

    // checking if user is already exist in database 
    $sql = "SELECT * FROM `sign_database` WHERE Token = '{$_SESSION['user_token']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // User is exist
        $userInfo = mysqli_fetch_assoc($result);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/google-dashboard.css">
    <link rel="shortcut icon" href="assets/images/logo/faviconKICT3.jpg">

    <title>Home Page</title>
</head>

<body>
    <img src="<?= $userInfo['picture'] ?>" alt="No image file uploaded" style="max-width: 15%;">

    <div class="view">
        <p>NAME:<br>
            <?= $userInfo['Fullname'] ?>
        </p>
        <p>EMAIL:<br>
            <?= $userInfo['Email'] ?>
        </p>
        <p>GENDER:<br>
            <?= $userInfo['Gender'] ?>
        </p>
    </div>
    <div>
        <a href="logout.php">
            <input type="button" class="rcorner" value="Logout" />
        </a>
    </div>
</body>

</html>