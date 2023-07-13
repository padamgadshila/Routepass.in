<?php
require_once './connect.php';

if (isset($_POST['update'])) {
    $pid        = mysqli_real_escape_string($conn, $_POST['id']);
    $fname      = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname      = mysqli_real_escape_string($conn, $_POST['lname']);
    $dob        = mysqli_real_escape_string($conn, $_POST['dob']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $number     = mysqli_real_escape_string($conn, $_POST['mobile']);
    $pass_type  = mysqli_real_escape_string($conn, $_POST['pass_type']);
    $start      = mysqli_real_escape_string($conn, $_POST['start']);
    $stop       = mysqli_real_escape_string($conn, $_POST['stop']);
    $update = mysqli_query($conn, "UPDATE `pass` SET `fname`='$fname',`lname`='$lname',`dob`='$dob',`email`='$email' ,`mobile`='$number',`pass_type`='$pass_type' where `pass_id` = '$pid'");
    if ($pass_type != 'Full') {
        $select = mysqli_query($conn, "SELECT * FROM `route` WHERE `pid`='$pid'");
        if (mysqli_num_rows($select) > 0) {
            $update = mysqli_query($conn, "UPDATE `route` SET `start`='$start',`stop`='$stop' where `pid`='$pid'");
        } else {
            $insert = mysqli_query($conn, "INSERT INTO `route`(`start`,`stop`,`pid`) VALUES('$start','$stop','$pid')");
        }
        header('location: payment.php');
    } else {
        $delete = mysqli_query($conn, "DELETE FROM `route` WHERE `pid` = '$pid'");
        header('location: payment.php');
    }
}
