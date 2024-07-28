<?php

session_start();
session_unset();
session_destroy();
header('location:index.php');

unset($_SESSION['user_token']);

?>