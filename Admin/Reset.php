<?php
require_once './connect.php';
$drop = mysqli_query($conn, "DELETE FROM `users`");
$drop = mysqli_query($conn, "DELETE FROM `pass`");
$drop = mysqli_query($conn, "DELETE FROM `plan`");
$drop = mysqli_query($conn, "DELETE FROM `route`");
$drop = mysqli_query($conn, "DELETE FROM `otp`");
$drop = mysqli_query($conn, "DELETE FROM `query`");

$inc = mysqli_query($conn, "ALTER TABLE `users` AUTO_INCREMENT = 1");
$inc = mysqli_query($conn, "ALTER TABLE `pass` AUTO_INCREMENT = 1000");
$inc = mysqli_query($conn, "ALTER TABLE `plan` AUTO_INCREMENT = 1");
$inc = mysqli_query($conn, "ALTER TABLE `route` AUTO_INCREMENT = 1");
$inc = mysqli_query($conn, "ALTER TABLE `otp` AUTO_INCREMENT = 1");
$inc = mysqli_query($conn, "ALTER TABLE `query` AUTO_INCREMENT = 1");
