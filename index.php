<?php
require_once './connect.php';
//fetching pass id for download purpose for the registered user
if (!empty($_SESSION['email'])) {
    $email  = $_SESSION['email'];
    $id     = $_SESSION['uid'];
    $query  = mysqli_query($conn, "SELECT * FROM `pass` WHERE `uid`='$id'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
    } else {
        $notFound = 'Not found';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Css -->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="shortcut icon" href="./images/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Css end-->

    <!-- js start -->
    <script src="./js/jquery.min.js"></script>
    <!-- js end -->
</head>

<body>
    <!-- Navigation Start-->
    <?php
    include('./navigation.php');
    ?>
    <!-- Navigation End-->
    <br>
    <!-- Banners Start -->
    <div class="banner">
        <img src="./images/routpass-banner.jpg">
    </div>
    <div class="banner2">
        <img src="./images/pass.png" class="ban2">
    </div>
    <!-- Banners End -->

    <!-- Services start  -->
    <div class="services" id="services">
        <br>
        <h2>Services</h2>
        <div class="options">
            <div class="pass">
                <div class="option-img">
                    <img src="./images/apply-pass.png">
                </div>
                <?php
                if (!empty($_SESSION['email'])) {
                ?>
                    <a href="./apply.php">Apply Pass</a>
                <?php
                } else {
                ?>
                    <a href="./login.php">Apply Pass</a>
                <?php
                }
                ?>
            </div>
            <div class="pass">
                <div class="option-img">
                    <img src="./images/renew-pass.png">
                </div>
                <?php
                if (!empty($_SESSION['email'])) {
                ?>
                    <a href="#renew" class="renewPass">Renew Pass</a>
                <?php
                } else {
                ?>
                    <a href="./login.php">Renew Pass</a>
                <?php
                }
                ?>
            </div>
            <div class="pass">
                <div class="option-img">
                    <img src="./images/update-pass.png">
                </div>
                <?php
                if (!empty($_SESSION['email'])) {
                ?>
                    <a href="./update.php?pass_id=<?php echo $row['pass_id'] ?>">Update Pass</a>
                <?php
                } else {
                ?>
                    <a href="./login.php">Update Pass</a>
                <?php
                }
                ?>
            </div>
            <div class="pass">
                <div class="option-img">
                    <img src="./images/downloa-pass.png">
                </div>
                <?php
                if (!empty($_SESSION['email'])) {
                ?>
                    <a href="./download.php?pass_id=<?php echo $row['pass_id'] ?>">Download Pass</a>
                <?php
                } else {
                ?>
                    <a href="./login.php">Download Pass</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Renew start -->
    <div class="renew">
        <i class="fas fa-x"></i>
        <div class="form-container">
            <form action="renew.php" method="post">
                <div class="input-container">
                    <div class="input">
                        <label class="title">Enter pass no</label>
                        <input type="number" name="passId" placeholder="Pass no" required>
                    </div>
                    <div class="input">
                        <label class="title">Enter duration</label>
                        <select name="duration">
                            <option>Select</option>
                            <option value="1-month">1 Month</option>
                            <option value="3-month">3 Month</option>
                        </select>
                    </div>
                </div>
                <div class="btn-container">
                    <button name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Renew end -->
    <!-- Services end  -->

    <!-- Content start -->
    <div class="container">
        <div class="left-sub-container">
            <img src="./images/eco public transport.jpg" alt="image">
        </div>
        <div class="right-sub-container">
            <div class="content">
                <br>
                <h1> <span>Electric Buses </span>In Public Transportation</h1>
                <p>The Government of India has set targets to reduce the economy's carbon intensity by 45% by 2030 and
                    achieve net zero emissions by 2070. It is possible only through the mass adoption of EVs, especially
                    in the public transportation system. Out of the 5,60,493 EVs sold in India (from January 2022 to
                    August 2022), two-wheelers and three-wheelers accounted for 94% of the total, four-wheelers 5%, and
                    e-buses 0.2%. Since e-buses account for a minor share of the EVs sold in the country, a monthly
                    increase in the vehicle fleet is warranted to achieve the net zero emissions target by 2070. As of
                    Q1 FY23, 467 e- buses have been sold, with a sequential increase of 39% and a YoY increase of 51%.
                </p>
            </div>
            <!-- <hr>    -->
            <div class="content-img">
                <h3><span>E-Buses</span> Solds In India</h3>
                <br>

                <img src="./images/ebuses solds in india.jpg" alt="ebuses solds in india">
            </div>
        </div>

    </div>
    <!-- Content end -->

    <!-- Footer Start -->
    <?php
    include('./footer.php');
    ?>
    <!-- Footer End -->

    <!-- Scripts -->
    <script>
        // Renew pass 
        let btn = document.querySelector('.renewPass'),
            renew = document.querySelector('.renew'),
            x = document.querySelector('.fa-x');
        btn.addEventListener('click', () => {
            window.scrollTo(0, 0);
            renew.classList.add('renew-show');
            setTimeout(() => {
                $('body').addClass('stop-scrolling');
            }, 500);
        });
        x.addEventListener('click', () => {
            renew.classList.remove('renew-show')
            window.scrollTo(0, 450)
            $('body').removeClass('stop-scrolling');
        });
    </script>

</body>

</html>