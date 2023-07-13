<?php
require_once './connect.php';
if (isset($_GET['user_id'])) {
    $_SESSION['userid'] = $_GET['user_id'];
    $edit = "SELECT *  FROM `users` WHERE `user_id`=" . $_GET['user_id'];
    $run = mysqli_query($conn, $edit);
    $rec = mysqli_fetch_assoc($run);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
        @font-face {
            font-family: unique;
            src: url('./css/Font/UnifySans.woff2');
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'unique';
            list-style: none;
            text-decoration: none;
            outline: none;
            border: none;
            transition: all .2s;
        }

        :root {
            --border-: #707070;
            --bg-: #1f1d1d;
            --bl-: #0088ff;
            --txt-: #ffffff;
            --btn-: #00B16A;
            --btn-hover-: #5a5adb;
            --foot-: #16275e;
            --radius-: 5px;
            --shadow-: 0px 0px 2px rgb(24, 24, 24);
            --center-: translate(-50%, -50%);
        }

        body {
            background: #dfe9f5;
        }

        .pop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgb(255, 255, 255, .4);
            backdrop-filter: blur(10px);
        }

        .form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: var(--center-);
            width: 30%;
            height: auto;
            background: var(--txt-);
            border: 1px solid var(--border-);
            border-radius: var(--radius-);
            padding: 15px;
        }

        .input {
            position: relative;
            width: 100%;
            height: 50px;
            margin-top: 30px;
        }

        .input input {
            border: 1px solid var(--border-);
            border-radius: var(--radius-);
            padding-left: 20px;
            width: 100%;
            height: 100%;
        }

        .input label {
            position: absolute;
            top: -20px;
        }

        .input button {
            text-align: center;
            width: 40%;
            background: var(--btn-);
            border-radius: var(--radius-);
            height: 50px;
            color: var(--txt-);
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="pop">
        <div class="fas fa-x"></div>
        <?php
        if (isset($_POST['update'])) {
            $fname  = mysqli_real_escape_string($conn, $_POST['fname']);
            $lname  = mysqli_real_escape_string($conn, $_POST['lname']);
            $email  = mysqli_real_escape_string($conn, $_POST['email']);
            $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
            $uid    = $_SESSION['userid'];
            $run    = mysqli_query($conn, "UPDATE `users` SET `fname` = '$fname',`lname`='$lname',`email`='$email',`mobile`='$mobile' WHERE `user_id`='$uid'");
            header('location:index.php#profile');
        }

        ?>
        <form action="./edit.php" method="post" class="form">
            <div class="input">
                <label>First name</label>
                <input type="text" name="fname" value="<?php echo $rec['fname']; ?>" required>
            </div>
            <div class="input">
                <label>Last name</label>
                <input type="text" name="lname" value="<?php echo $rec['lname']; ?>" required>
            </div>
            <div class="input">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $rec['email']; ?>" required>
            </div>
            <div class="input">
                <label>Mobile</label>
                <input type="number" name="mobile" value="<?php echo $rec['mobile']; ?>" required>
            </div>
            <div class="input">
                <button type="submit" name="update">Update</button>
            </div>
        </form>
    </div>
</body>

</html>