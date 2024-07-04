<?php
include "./db/config.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['login'])){

        $username = $_POST['username'];
        
        $password = $_POST['password'];

        $sql =  "SELECT * FROM `sign_database` WHERE Username = '$username' AND Password = '$password'";

        $result = mysqli_query($conn,$sql);
       
        if($result){
            $num = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if($num > 0){
                echo "<script> alert('Success! You are successfully logged in.'); </script>";
                $_SESSION['Username'] = $username;
                header('location:home.php');
            }else{
            echo "<script> alert('Error! Invalid data'); </script>";
        }
    }
}
    if(isset($_POST['signin'])){

        $email = $_POST['email'];
        
        $username = $_POST['username'];
        
        $photo = 'upload/'.$_FILES['image']['name'];
        
        $password = $_POST['password'];
        
        $confirmpassword = $_POST['confirmpassword'];

        $sql = "SELECT * FROM `sign_database` WHERE Username = '$username' OR Email = '$email'";
        $result = mysqli_query($conn,$sql);
        if($result){
            $num = mysqli_num_rows($result);
            if($num>0){
            echo "<script> alert('Ohh no Sorry! Username or Email has already existed'); </script>";
            }else{
                if($password === $confirmpassword){
                    if(preg_match("!image!", $_FILES['image']['type'])){
                        if(copy($_FILES['image']['tmp_name'], $photo)){
                        
                        }else{
                            echo "<script> alert('Sorry! File uploaded failed!'); </script>";
                        }
                    }else{
                        echo "<script> alert('Opps! Please upload only JPG, PNG or GIF image!'); </script>";
                    }
                $sql = "INSERT INTO `sign_database` (Email, Username, Photo, Password) VALUES ('$email','$username','$photo','$password')"; 
                $result = mysqli_query($conn,$sql);
                if ($result === TRUE){
                        echo "<script> alert('Success! You are successfully signed up'); </script>";
                        $_SESSION['Username'] = $username;
                    header('location:home.php');
                    }else{
                        echo "<script> alert('Sorry! User could not be added!'); </script>";
                    }
                }else{
                    echo "<script> alert('Incorrect! Password does not match'); </script>";
                }
            }
        }
    }  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Login page</title>
    <link rel="shortcut icon" href="assets/images/logo/faviconKICT3.jpg">
</head>

<body>
    <div class="countainer">
        <h1>
            <b>KICT</b><sup>experience IT</sup>
        </h1>
        <h2>KNOW IT ICT LTD. </h2>
        <address>
            ADD: No. 23 Albarka Plaza,Justice Dahiru Mustapha Avenue Farm Center Kano.<br>
            Phone No.:08034099090,08095743914,08038933443. Email:knowitict@gmail.com. Google:kict.online.
        </address>
    </div>

    <div class="glass">
        <div class="form-box login">
            <!-- <a href="#">
                <span class="icon-close"><ion-icon name="close">✖</ion-icon></span>
            </a><br> -->
            <b>LOGIN</b>
            <form action="index.php" method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="username">🧑🏻</ion-icon>
                    </span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <img src="assets/images/avatars/password-hide-icon.png" alt="" class="password-icon"
                            id="password-icon" onchange="change()">
                    </span>
                    <input type="password" name="password" id="password" required>
                    <label>Password</label>
                </div>
                <br>
                <div class="remember">
                    <label><input type="checkbox">Remember me</label>
                    <a href="forgot-password.php">
                        Forgot Password?
                    </a>
                </div>
                <br>
                <div>
                    <input type="submit" name="login" class="rcorners" value="Login">
                </div>
                <div class="rcorner">
                    <span class="buttons">
                        <div class="logo">
                            <?php
                                    if (isset($_SESSION['user_token'])) {
                                        header("Location: google-dashboard.php");
                                    } else {
                                    echo "<a href='".$client->createAuthUrl()."'>continue with Google</a>";
                                    }
                                ?>
                        </div>
                    </span>
                </div>
                <div class="login-register">
                    <p>If you don't have an account?<a href="#" class="register-link">Sign up</a></p>
                </div>
            </form>
        </div>


        <div class="form-box register">
            <b>Register</b>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="email">🧑🏻</ion-icon>
                    </span>
                    <input type="text" name="email" required>
                    <label>email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="username">🧑🏻</ion-icon>
                    </span>
                    <input type="text" name="username" required>
                    <label>username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed">🔒</ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed">🔒</ion-icon>
                    </span>
                    <input type="password" name="confirmpassword" required>
                    <label>Confirm password</label>
                </div>
                <div class="input-image">
                    <span class="icon">
                        <ion-icon name="image">🧑🏻</ion-icon>
                    </span>
                    <input type="file" name="image" id="imageInput" accept="image/*">
                    <label for="file">Upload image</label>
                </div>
                <br>
                <div class="remember">
                    <label><input type="checkbox">I agree to the terms & conditions</label>
                </div>
                <div>
                    <input type="submit" name="signin" class="rcorners" value="Sign in">
                </div>
                <div class="login-register">
                    <p>Already have an account?<a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/index.js"></script>
</body>

</html>