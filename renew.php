<?php
require_once './connect.php';
if (isset($_POST['submit'])) {
    $pid          = mysqli_real_escape_string($conn, $_POST['passId']);
    $duration     = mysqli_real_escape_string($conn, $_POST['duration']);

    $select = mysqli_query($conn, "SELECT * FROM `pass` WHERE `pass_id` ='$pid'");
    if (mysqli_num_rows($select) > 0) {

        $update     = mysqli_query($conn, "UPDATE `plan` set `issue` = NOW() where `pid` = '$pid'");
        $select     = mysqli_query($conn, "SELECT * FROM `plan` where `pid` = '$pid '");
        $row        = mysqli_fetch_assoc($select);
        $old_date   = $row['issue'];
        if ($duration === '1-month') {
            $update = mysqli_query($conn, "UPDATE `pass` set `duration` = '$duration' where `pass_id` = '$pid'");
            $update = mysqli_query($conn, "UPDATE `plan` set `renew` = addDate('$old_date',INTERVAL 1 month) where `pid` = '$pid'");
        } else {
            $update = mysqli_query($conn, "UPDATE `pass` set `duration` = '$duration' where `pass_id` = '$pid'");
            $update = mysqli_query($conn, "UPDATE `plan` set `renew` = addDate('$old_date',INTERVAL 3 Month) where `pid` = '$pid'");
        }
        header('location:payment.php');
    } else {
        echo '<h1>Invalid Pass no, try again</h1>';
    }
}
