<?php
session_start();
if(empty($_SESSION['id'])){
     header('location:login.php');
}else{
    $_SESSION['otp'] = random_int(100000, 999999);
     header('location: verify.php');
}
?>