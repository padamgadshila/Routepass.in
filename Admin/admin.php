<?php
require_once 'connect.php';
if (isset($_POST['login'])) {
    $username   = $_POST['username'];
    $password   =  $_POST['password'];
    $query      = mysqli_query($conn, "SELECT * FROM `admin` WHERE `username`='$username'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['admin'] = $row['username'];
        if ($password == $row['password']) {
            header("location:index.php");
        } else {
            $wrongpass = "*wrong password";
        }
    } else {
        $invaliduser = "*User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <div class="form-container">
        <h2>Admin Login</h2>
        <form action="admin.php" method="post">
            <div class="input-container">
                <div class="input">
                    <input type="text" placeholder="username" name="username" required>
                    <i class="fas fa-user"></i>
                    <?php
                    if (isset($invaliduser)) {
                    ?>
                        <span class="message" style="display:block">
                            <?php echo $invaliduser; ?>
                        </span>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="input-container">
                <div class="input">
                    <input type="password" placeholder="password" name="password" required>
                    <i class="fas fa-lock"></i>
                    <?php
                    if (isset($wrongpass)) {
                    ?>
                        <span class="message" style="display:block">
                            <?php echo $wrongpass; ?>
                        </span>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="btn-container">
                <div class="input">
                    <button type="submit" name="login">Login</button>
                </div>
            </div>
        </form>

    </div>
</body>

</html>