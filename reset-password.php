<?php
include "./db/config.php";

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM `sign_database` WHERE Reset_token_hash = ?";

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

    <h1>Reset Password</h1>

    <form action="mail/process-password-reset.php" method="post">

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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

</html>