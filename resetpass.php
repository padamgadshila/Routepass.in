<?php
require_once('connect.php');
unset($_SESSION['otp']);
if (empty($_SESSION['id'])) {
    header('location:login.php');
} else {
    if (isset($_POST['change'])) {
        $pass   = mysqli_real_escape_string($conn, $_POST['password']);
        $pass2  = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $id     = $_SESSION['id'];

        if ($pass === $pass2) {
            $password = password_hash($pass, PASSWORD_BCRYPT);
            $query    =  mysqli_query($conn, "UPDATE `users` SET `password`='$password' WHERE `user_id` = '$id'");
            if ($query == TRUE) {
                $success = "Password reset successfull";
                header("location: login.php");
            }
        } else {
            $passerr = "*Password dosen't match";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="./css/recovery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>

<body>
    <div class="pass-container">
        <h2>Reset Password</h2>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="input-container">
                <div class="input">
                    <input type="password" name="password" placeholder="Create password" required>
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <div class="input-container">
                <div class="input">
                    <input type="password" name="cpassword" placeholder="Confirm password" required>
                    <i class="fas fa-envelope"></i>
                    <?php
                    if (isset($passerr)) {
                    ?>
                        <span class="message" style="display:block">
                            <?php echo $passerr; ?>
                        </span>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="input-container">
                <div class="input">
                    <button name="change">Reset</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>