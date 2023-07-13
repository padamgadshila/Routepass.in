<?php
require_once('connect.php');
if (isset($_POST['register'])) {
    $fname  = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname  = mysqli_real_escape_string($conn, $_POST['lname']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $pass   = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass  = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $query  = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'");

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($email == $row['email']) {
                $exist  = "*Email already used, try another email";
            }
        }
    } else {
        if ($pass === $cpass) {
            $password   = password_hash($pass, PASSWORD_BCRYPT);
            $query      = mysqli_query($conn, "INSERT INTO `users`(`fname`,`lname`,`email`,`mobile`,`password`) VALUES('$fname','$lname','$email','$mobile','$password')");
            if ($query == TRUE) {
                $_SESSION['success'] = "Registered successfully";
                $_SESSION['push'] = 'login.php';
            }
        } else {
            $passerror = "*Password dosen't match";
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
    <title>Register Form</title>
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="register">
    <div class="loader">
        <img src="./images/route-loading.gif">
    </div>
    <div class="form-container">
        <div class="form-left">
            <div class="logo">
                <img src="./images/logo.png">
            </div>
            <h2>Register now</h2>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="input-container">
                    <div class="input">
                        <input type="text" name="fname" placeholder="First name" required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="input">
                        <input type="text" name="lname" placeholder="Last name" required>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <input type="email" name="email" placeholder="Email" required>
                        <i class="fas fa-envelope"></i>
                        <?php
                        if (isset($exist)) {
                        ?>
                            <span class="message" style="display:block">
                                <?php echo $exist; ?>
                            </span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="input">
                        <input type="number" name="mobile" placeholder="Mobile" required>
                        <i class="fas fa-mobile"></i>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <input type="password" name="password" placeholder="Password" id="pass" required>
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="input">
                        <input type="password" name="cpassword" placeholder="Confrim" id="cpass" required>
                        <i class="fas fa-lock"></i>
                        <?php
                        if (isset($passerror)) {
                        ?>
                            <span class="message" style="display:block">
                                <?php echo $passerror; ?>
                            </span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="show-password">
                    <input type="checkbox" class="check">
                    <p>show password</p>
                </div>
                <div class="input-container">
                    <div class="input">
                        <h4>Already registered? <a href="login.php">Login</a></h4>
                    </div>
                    <div class="input">
                        <button name="register">Register</button>
                    </div>
                </div>
                <script>
                    let pass = document.getElementById("pass");
                    let cpass = document.getElementById("cpass");
                    let click = document.querySelector(".check");
                    click.addEventListener('click', () => {
                        if (pass.type === "password" && cpass.type === "password") {
                            pass.type = "text";
                            cpass.type = "text";
                        } else {
                            pass.type = "password";
                            cpass.type = "password";
                        }
                    });
                </script>
            </form>
        </div>
        <div class="form-rigt">
            <div class="poster">
                <img src="./images/pass.png">
            </div>
        </div>
    </div>


    <?php
    include('./alert.php');
    ?>


    <script>
        var loader = document.querySelector('.loader');
        window.addEventListener("load", function() {
            loader.style.display = "none";
        });
    </script>
</body>

</html>