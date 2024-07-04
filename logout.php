<?php

session_start();
unset($_SESSION['user_token']);
session_destroy();
header('location:home.php');

?>