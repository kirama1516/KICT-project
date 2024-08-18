<?php

include "./db/config.php";

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM `sign_database` WHERE Reset_token_hash = ?";

$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_bind_param($stmt, "s", $token_hash);

mysqli_stmt_execute($stmt);

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["Reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

// echo "token is valid";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reset-password.css">
    <link rel="shortcut icon" href="assets/images/logo/faviconKICT3.jpg">
    <title>Reset password</title>

</head>

<body>

    <h1>Reset Password</h1>

    <form action="reset-password-process.php" method="post">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <div class="mb-3">
            <label for="password" class="form-label">New password:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
        </div>
        <div class="mb-3">
            <label for="confirmpassword" class="form-label">Comfirm password</label>
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword"
                placeholder="Repeat">
        </div>

        <button type="submit" class="btn btn-primary" name="send">send</button>

    </form>
</body>

</html>