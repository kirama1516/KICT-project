<?php

// include './db/config.php';
// include './mail/mailer.php';

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expires = date("Y-m-d H:i:s", time() + 3600);

$mysqli = include __DIR__ . './db/config.php';

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

    $mail = include __DIR__ . "../mail/mailer.php";

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
        
        Click <a href="http://localhost/myshop/mail/reset-password.php?token=$token">here</a>
        to reset your password.

        END;

    try {

        $mail->send();
    } catch (Exception $e) {

        echo "<script> alert('Message could not be sent. Mailer error: {$mail->ErrorInfo}'); </script>";
    }
}

echo "<script> alert('Message sent, Please check your inbox.'); </script>";


?>