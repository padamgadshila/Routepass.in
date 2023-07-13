<link rel="stylesheet" href="./css/navigation.css">
<link rel="stylesheet" href="./fontawesome-free-6.4.0-web/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="./js/jquery.min.js"></script>
<!-- Loader start -->
<div class="loader">
    <img src="./images/route-loading.gif">
</div>
<!-- Loader  end -->

<nav>
    <div class="logo">
        <img src="./images/logo2.png" alt="logo">
    </div>
    <ul class="nav-list">
        <?php
        if (empty($_SESSION['email'])) {
        ?>
            <li class="nav-respone"><a href="login.php">Login</a></li>
        <?php
        }
        ?>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./index.php#services">Services</a></li>
        <li><a href="./Aboutus.php">About</a></li>
        <li><a href="./helpline.php">Helpline</a></li>
        <?php
        if (!empty($_SESSION['email'])) {
        ?>
            <li class="nav-respone"><a href="./Users-logout.php">Logout</a></li>
        <?php
        }
        ?>
        <li>
            <div class="fas fa-user">
                <?php
                if (!empty($_SESSION['email'])) {
                    if (isset($notFound)) {
                ?>
                        <img src="./images/default-user.jpg">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo 'admin/img/'.$row['email'].'/' . $row['user_pic']; ?>">
                <?php
                    }
                }
                ?>
            </div>
        </li>
    </ul>
    <div class="profile-cont">
        <?php
        if (empty($_SESSION['email'])) {
        ?>
            <div class="login-signup" style="opacity: 1;visibility: visible;">
                <a href="./login.php">LogIn</a>
            </div>
        <?php
        } else {
        ?>
            <ul class="profile" style="opacity: 1;visibility: visible;">
                <li><b>
                        <?php
                        if (!empty($_SESSION['email'])) {
                            echo $_SESSION['fname'] . " " . $_SESSION['lname'];
                        }
                        ?>
                    </b></li>
                <li> <a href="./Users-logout.php">Logout</a></li>
            </ul>
        <?php
        }
        ?>
    </div>
    <div class="fas fa-bars">
        <?php
        if (!empty($_SESSION['email'])) {
            if (isset($notFound)) {
        ?>
                <img src="./images/default-user.jpg">
            <?php
            } else {
            ?>
                <img src="<?php echo 'admin/img/'.$row['email'].'/' . $row['user_pic']; ?>">
        <?php
            }
        }
        ?>
    </div>
</nav>

<script>
    // Side navigation
    let menu = document.querySelector('.fa-bars'),
        navigation = document.querySelector('.nav-list');

    menu.addEventListener('click', () => {
        navigation.classList.toggle('nav-list-slide');
    });

    // profile slide
    let person = document.querySelector('.fa-user'),
        profile = document.querySelector('.profile-cont');

    person.addEventListener('click', () => {
        profile.classList.toggle('profile-slide');
    });
    window.addEventListener('scroll', () => {
        profile.classList.remove('profile-slide');
    })
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