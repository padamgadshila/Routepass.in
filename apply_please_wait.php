<?php
require_once './connect.php';

$email_  = $_SESSION['email'];
$id      = $_SESSION['uid'];
if (isset($_POST['apply'])) {
    $_SESSION['success'] = "Please wait...";
    $fname      = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname      = mysqli_real_escape_string($conn, $_POST['lname']);
    $dob        = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $number     = mysqli_real_escape_string($conn, $_POST['mobile']);
    $state      = mysqli_real_escape_string($conn, $_POST['state']);
    $city       = mysqli_real_escape_string($conn, $_POST['city']);
    $zipcode    = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $pass_type  = mysqli_real_escape_string($conn, $_POST['pass_type']);
    $start      = mysqli_real_escape_string($conn, $_POST['start']);
    $stop       = mysqli_real_escape_string($conn, $_POST['stop']);
    $duration   = mysqli_real_escape_string($conn, $_POST['duration']);

    // Storing image name
    $user_pic   = $_FILES['user_pic']['name'];
    $college_id = $_FILES['college_id']['name'];
    $aadhar     = $_FILES['aadhar_card']['name'];
    $bonofide   = $_FILES['bonofide']['name'];

    //defining location to store the pics
    mkdir("admin/img/$email");
    $user   = "admin/img/$email/" . $user_pic;
    $col    = "admin/img/$email/" . $college_id;
    $bono   = "admin/img/$email/" . $bonofide;
    $ad     = "admin/img/$email/" . $aadhar;
    //moving the images to those location
    move_uploaded_file($_FILES['user_pic']['tmp_name'], $user);
    move_uploaded_file($_FILES['college_id']['tmp_name'], $col);
    move_uploaded_file($_FILES['aadhar_card']['tmp_name'], $bono);
    move_uploaded_file($_FILES['bonofide']['tmp_name'], $ad);

    //Creating the qrcode for the user
    require_once 'phpqrcode/qrlib.php';
    $path = "admin/img/$email/";
    $qrcode = $path . time() . ".png";
    QRcode::png('uid = ' . $id . ', name = ' . $fname . ' ' . $lname, $qrcode, 'H', 4, 4);

    $insert = mysqli_query($conn, "INSERT INTO `pass`(`fname`,`lname`,`dob`,`gender`,`email`,`mobile`,`user_pic`,`college_id`,`aadhar_card`,`bonofide`,`state`,`city`,`zipcode`,`pass_type`,`duration`,`qrcodes`,`uid`) VALUES('$fname','$lname','$dob','$gender','$email','$number','$user_pic','$college_id','$aadhar','$bonofide','$state','$city','$zipcode','$pass_type','$duration','$qrcode','$id')");
    $select = mysqli_query($conn, "SELECT * FROM `pass` WHERE `uid` ='$id'");
    $row    = mysqli_fetch_assoc($select);
    $pid    = $row['pass_id'];

    if ($pass_type != 'Full') {
        $insert = mysqli_query($conn, "INSERT INTO `route`(`start`,`stop`,`pid`) VALUES('$start','$stop','$pid')");
    }
    $insert = mysqli_query($conn, "INSERT INTO `plan`(`issue`,`pid`)VALUES(NOW(),'$pid')");
    $select = mysqli_query($conn, "SELECT * FROM `plan` where `pid` = '$pid '");
    $row    = mysqli_fetch_assoc($select);
    $old_date = $row['issue'];
    if ($duration === '1-month') {
        $update = mysqli_query($conn, "UPDATE `plan` set `renew` = addDate('$old_date',INTERVAL 1 month) where `pid` = '$pid'");
    } else {
        $update = mysqli_query($conn, "UPDATE `plan` set `renew` = addDate('$old_date',INTERVAL 3 Month) where `pid` = '$pid'");
    }
    // header('location: payment.php');
    $_SESSION['push'] = 'payment.php';
}
?>

<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'unique';
            list-style: none;
            text-decoration: none;
            outline: none;
            border: none;
            transition: all .4s;
            scroll-behavior: smooth;
        }

        /* Loader start */
        .loader {
            width: 100%;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            background: #fff;
            z-index: 100;
        }

        .loader img {
            width: 10%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Loader end */
        @media (max-width:400px) {
            .loader {
                width: 100%;
                height: 100vh;
                background: var(--txt-);
                z-index: 100;
            }

            .loader img {
                width: 30%;
            }
        }
    </style>
</head>

<body>
    <!-- Loader start -->
    <div class="loader">
        <img src="./images/route-loading.gif">
    </div>
    <!-- Loader  end -->
    <?php
    include('alert.php');
    ?>

    <script>
        // Loader
        window.addEventListener('load', () => {
            window.scrollTo(0, 0);
        })
        $(document).ready(() => {
            setTimeout(() => {
                $('.loader').css('display', 'none');
            }, 1000);
        });
    </script>
</body>