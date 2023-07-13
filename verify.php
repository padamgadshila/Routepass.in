<?php
require_once('connect.php');

$id         = $_SESSION['id'];
$code       = $_SESSION['otp'];
$query      = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id`='$id'");
if (mysqli_num_rows($query) > 0) {
    $row    = mysqli_fetch_assoc($query);
    $query  = mysqli_query($conn, "INSERT INTO `otp`(`otps`,`uid`) VALUES('$code','$id') ");
}

if (isset($_POST['verify'])) {
    $code   = $_POST['otp'];
    $id     = $_SESSION['id'];

    $query  = mysqli_query($conn, "SELECT `otps` FROM `otp` WHERE `uid`='$id'");
    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_assoc($query)) {
            $vcode = $row['otps'];
        }
        if ($code === $vcode) {
            $query = mysqli_query($conn, "DELETE FROM `otp` WHERE `uid` = '$id'");
            header("location: resetpass.php");
        } else {
            $invalid = "*Invalid otp try again";
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
    <title>Email</title>
    <link rel="stylesheet" href="./css/recovery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <div class="form-container">
        <h2>Verify otp</h2>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="input-container">
                <div class="input">
                    <input type="number" name="otp" placeholder="enter your otp" required>
                    <i class="fas fa-mobile"></i>
                    <?php
                    if (isset($invalid)) {
                    ?>
                        <span class="message" style="display:block">
                            <?php echo $invalid; ?>
                        </span>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="input-container">
                <div class="input">
                    <button name="verify">Verify</button>
                </div>
            </div>
            <div class="input-container">
                <div class="input">
                    <a class="resend" href="./otp.php">Resend otp</a>
                </div>
            </div>
        </form>
    </div>
    <div class="otp">
        <strong><?php echo $_SESSION['otp']; ?></strong>
    </div>
    <script>
        let otp = document.querySelector('.otp');
        window.addEventListener('load', () => {
            otp.classList.add('otp-pop');
        });
    </script>
</body>

</html>