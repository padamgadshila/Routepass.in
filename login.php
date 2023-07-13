<?php
require_once('connect.php');

if (isset($_POST['login'])) {
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $query      = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['uid']    = $row['user_id'];
        $_SESSION['fname']  = $row['fname'];
        $_SESSION['lname']  = $row['lname'];
        $_SESSION['email']  = $row['email'];
        $vri = password_verify($password, $row['password']);
        if ($vri == 1) {
            $_SESSION['success'] = "Logged in successfully";
            $_SESSION['push'] = 'index.php';
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
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="login">
    <?php
    include('./alert.php');
    ?>
    <div class="loader">
        <img src="./images/route-loading.gif">
    </div>
    <div class="form-container">
        <div class="logo">
            <img src="./images/logo.png">
        </div>
        <h2>Sign in</h2>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
            <div class="input-container">
                <div class="input">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="fas fa-envelope"></i>
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
                    <input type="password" name="password" placeholder="Password" required>
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
            <div class="input-container">
                <div class="input">
                    <button name="login">Login</button>
                </div>
            </div>
            <div class="input-container">
                <div class="input">
                    <h4 class="pforgot">Forgot your password?</h4>
                    <h4>Haven't registered yet? <a href="register.php">Register</a></h4>
                </div>
            </div>
        </form>
    </div>
    <!-- Pop for recovery start-->
    <div class="select-cont">
        <i class="fas fa-x"></i>
        <div class="select">
            <h2>Choose the method</h2>
            <div>
                <a href="./email.php">Email</a>
                <a href="./mobile.php">Mobile</a>
            </div>
        </div>
    </div>
    <!-- Pop for recovery end -->
    <script>
        var loader = document.querySelector('.loader');
        window.addEventListener("load", function() {
            loader.style.display = "none";
        });

        let btn = document.querySelector('.pforgot');
        let x = document.querySelector('.fa-x');
        let option = document.querySelector('.select-cont');
        btn.addEventListener('click', () => {
            option.classList.add('select-cont-show')
        });
        x.addEventListener('click', () => {
            option.classList.remove('select-cont-show')
        });
    </script>
</body>

</html>