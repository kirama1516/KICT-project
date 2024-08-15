<?php

// include "./db/config.php";
include '/var/www/html/kict-project/db/config.php';

    $token = $_POST["token"];

    $token_hash = hash("sha256", $token);

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
                mysqli_stmt_prepare($stmt, $sql);

                $hashPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "si", $hashPwd, $user["Id"]);
                mysqli_stmt_execute($stmt);
                header("Location: index.php?passwordUpdate=you can now login");
                exit();

            }

                // echo "<script> alert('Password update, You can now login.'); </script>";

    }

?>