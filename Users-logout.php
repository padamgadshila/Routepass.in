<?php
session_start();
if (!empty($_SESSION['email'])) {
    unset($_SESSION['email']);
    unset($_SESSION['uid']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    // session_destroy();
    header('location: index.php');
}
