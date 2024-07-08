<?php

include './db/config.php';

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$mysqli = include __DIR__. './db/config.php';

$sql = "SELECT * FROM `sign_database` WHERE Rest_token_hash = ?";

$stmt = mysqli_stmt_init($conn);
     
mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_bind_param($stmt, "s", $token_hash,);

mysqli_stmt_execute($stmt);

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["Reset_token_expires_at"]) <= time()) {
    die("token has expired"); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['send'])) {

        $password = $_POST['password'];

        $confirmpassword = $_POST['confirmpassword'];

    }
}
if ($password == $confirmpassword) {

    echo "<script> alert('Success! You are successfully signed up'); </script>";

} else{

    echo "<script> alert('Incorrect! Password does not match'); </script>";

}

$sql = "UPDATE `sign_database`
        SET Password = ?,
            Reset_token_hash = NULL,
            Reset_token_expires_at = NULL
        WHERE Id = ?";

$stmt = mysqli_stmt_init($conn);
     
mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_bind_param($stmt, "ss", $password, $user["Id"]);

mysqli_stmt_execute($stmt);

echo "<script> alert('Password update, You can now login.'); </script>";

?>