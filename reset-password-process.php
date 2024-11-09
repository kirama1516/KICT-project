<?php

// include "./db/config.php";
include '/var/www/html/kict-project/db/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["token"])) {
    $token = $_POST["token"];

    $token_hash = hash("sha256", $token);

    $sql = "SELECT * FROM `sign_database` WHERE Reset_token_hash = ?";

    // Initialize statement
    $stmt = mysqli_stmt_init($conn);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Prepared statement failed: " . $conn->error);
    }

    // Prepare the statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("Prepared statement failed: " . mysqli_stmt_error($stmt));
    }

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "s", $token_hash);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($user === null) {
        die("Token not found");
    }

    if (strtotime($user["Reset_token_expires_at"]) <= time()) {
        die("Token has expired");
    }

    if (isset($_POST['send'])) {
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        if ($password !== $confirmpassword) {
            header("Location: reset-password.php?error=passwordCheck");
            exit();
        } else {
            $sql = "UPDATE `sign_database`
                    SET Password = ?,
                        Reset_token_hash = NULL,
                        Reset_token_expires_at = NULL
                    WHERE Id = ?";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die("Prepared statement failed: " . mysqli_stmt_error($stmt));
            }

            $hashPwd = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "ss", $hashPwd, $user["Id"]);
            mysqli_stmt_execute($stmt);
            header("Location: index.php?passwordUpdate=you can now login");
            exit();
        }
    }
} else {
    die("Token not provided");
}


?>