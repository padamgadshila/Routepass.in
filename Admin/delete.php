<?php
require_once './connect.php';

if (isset($_GET['user_id'])) {

    $delete = mysqli_query($conn, "DELETE FROM `users` WHERE `user_id`=" . $_GET['user_id']);
    header('location: index.php#profile');
}
if (isset($_GET['pass_id'])) {
    $select = mysqli_query($conn, "SELECT * from `pass` WHERE `pass_id` =" . $_GET['pass_id']);
    $row    = mysqli_fetch_assoc($select);
    $uid    = $row['uid'];
    $select2 = mysqli_query($conn, "SELECT *  FROM `users` WHERE `user_id`='$uid'");
    $us  = mysqli_fetch_assoc($select2);
    unlink('img/' . $us['email'] . '/' . $row['user_pic']);
    unlink('img/' . $us['email'] . '/' . $row['aadhar_card']);
    unlink('img/' . $us['email'] . '/' . $row['college_id']);
    unlink('img/' . $us['email'] . '/' . $row['bonofide']);
    $qr = str_replace('admin/', '', $row['qrcodes']);
    unlink($qr);
    rmdir('img/' . $us['email']);
    $delete = mysqli_query($conn, "DELETE FROM `pass` WHERE `pass_id`=" . $_GET['pass_id']);
    header('location: index.php#profile');
}
if (isset($_GET['plan_id'])) {
    $delete = mysqli_query($conn, "DELETE FROM `plan` WHERE `plan_id`=" . $_GET['plan_id']);
    header('location: index.php#profile');
}
if (isset($_GET['rout_id'])) {
    $delete = mysqli_query($conn, "DELETE FROM `route` WHERE `rout_id`=" . $_GET['rout_id']);
    header('location: index.php#profile');
}
if (isset($_GET['qid'])) {
    $select = mysqli_query($conn, "SELECT * from `query` WHERE `qid` =" . $_GET['qid']);
    $row = mysqli_fetch_assoc($select);
    unlink('img/query/' . $row['email'] . '/' . $row['messagepic']);
    rmdir('img/query/' . $row['email']);
    $delete = mysqli_query($conn, "DELETE FROM `query` WHERE `qid`=" . $_GET['qid']);
    header('location: index.php#profile');
}
