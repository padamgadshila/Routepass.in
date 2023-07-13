<?php
include_once './connect.php';

if (isset($_POST['get_otp'])) {
    $email = $_POST['email'];
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        unset($_SESSION['id']);
        $_SESSION['id'] = $row['user_id'];
        header("location:otp.php");
    } else {
        $invalid = "*invalid email";
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
        <h2>Get otp</h2>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="input-container">
                <div class="input">
                    <input type="email" name="email" placeholder="enter your email" required>
                    <i class="fas fa-envelope"></i>
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
                    <button name="get_otp">Get Otp</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>