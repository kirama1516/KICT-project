<?php

include "./db/config.php";
include "./mail/mailer.php";

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

        //    // Check if email is set
        // if (!isset($_POST['email']) || empty($_POST['email'])) {
        // throw new Exception('Email address is required');
        // }
        
        // $email = $_POST['email'];
        
        // // Validate email address
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // throw new Exception('Invalid email address');
        // }

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
    <link rel="shortcut icon" href="assets/images/logo/faviconKICT3.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
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

        <button type="submit" class="btn btn-primary" name="reset-pswrd">send</button>

    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

</html>