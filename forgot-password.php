<?php

include "./db/config.php";
include "/var/www/html/kict-project/mail/mailer.php";

if (isset($_POST['email'])) {

    $email = $_POST["email"];

    $token = bin2hex(random_bytes(16));

    $token_hash = hash("sha256", $token);

    $expires = date("Y-m-d H:i:s", time() + 60 * 30);

    $sql = "UPDATE `sign_database` 
    SET Reset_token_hash = ?, 
        Reset_token_expires_at = ? 
        WHERE Email = ?";

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "sss", $token_hash, $expires, $email);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);


    if ($conn->affected_rows) {

        $mail->setFrom("knowitict@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->Body = <<<END
        
        Click <a href="http://localhost/kict-project/reset-password.php?token=$token">here</a>
        to reset your password.

        END;

        try {

            $mail->send();
        } catch (Exception $e) {

            echo "<script> alert('Message could not beee sent. Mailer error: {$mail->ErrorInfo}'); </script>";
        }
    }

    echo "<script> alert('Message sent, Please check your inbox.'); </script>";

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/forgot-password.css">
    <link rel="shortcut icon" href="assets/images/logo/faviconKICT3.jpg">
    <title>Forgot password</title>

</head>

<body>

    <h1>Forgot Password</h1>
    <p>An email will be send to you with instructions on how to reset your password.</p>

    <form action="forgot-password.php" method="post">

        <div class="mb-3">
            <label for="email" class="form-label">EMAIL:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address">
        </div>

        <button type="submit" class="btn" name="reset-pswrd">send</button>

    </form>
</body>

</html>