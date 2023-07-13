<?php
require_once './connect.php';

if (!empty($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $id = $_SESSION['uid'];
    $query = mysqli_query($conn, "SELECT * FROM `pass` WHERE `uid`='$id'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
    } else {
        $notFound = 'Not found';
    }
}

if (isset($_POST['submit'])) {
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $query = $_POST['query'];
    // Storing image name
    $queryimg   = $_FILES['queryimg']['name'];

    //defining location to store the pics
    mkdir("admin/img/query/$email");
    $queryloc   = "admin/img/query/$email" . '/' . $queryimg;

    //moving the images to those location
    move_uploaded_file($_FILES['queryimg']['tmp_name'], $queryloc);

    $insert = mysqli_query($conn, "INSERT INTO `query`(`name`, `email`, `message`, `messagepic`) VALUES ('$fullname','$email','$query','$queryimg')");
    if ($insert = true) {
        $_SESSION['done'] = "Thanks for your feedback <br> we'll respond to you soon";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- Link for css -->
    <link rel="stylesheet" href="./css/helpline.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="./js/jquery.min.js"></script>
</head>

<body>
    <!-- Navigation Start-->
    <?php
    include('./navigation.php')
    ?>
    <!-- Navigation End-->


    <!-- Banners -->
    <div class="banner">
        <div class="left">
            <img src="./images/help.png">
        </div>
        <div class="right">
            <img src="./images/line.png ">
        </div>
    </div>
    <!-- Banners Close -->

    <!-- helpline form -->
    <div class="form-container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" class="form" id="form">
            <h2>Contact Us</h2>
            <div class="input-container">
                <div class="input">
                    <label class="title">Full Name</label>
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>
            </div>
            <div class="input-container">
                <div class="input">
                    <label class="title">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
            </div>
            <div class="input-container">
                <div class="input">
                    <label class="title">Your Message</label>
                    <textarea rows="5" name="query" cols="33" placeholder="Enter Your Queries" required></textarea>
                </div>
            </div>
            <div class="input-container">
                <div class="input">
                    <label class="title">Screenshot</label>
                    <input type="file" name="queryimg" id="cid" hidden onchange="getname1(this.value)" required>
                    <label for="cid" class="file">
                        <p id="file1">No file selected</p>
                    </label>
                </div>
            </div>
            <div class="btn-container">
                <button name="submit" name="submit" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <style>
        .pop-cont {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(255, 255, 255, .1);
            backdrop-filter: blur(10px);
            transform: scale(0);
        }

        .pop {
            width: 300px;
            height: 150px;
            border-radius: 5px;
            background: lightgreen;
            color: green;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .fa-x {
            position: absolute;
            top: 10px;
            right: 10px;
            color: green;
            font-size: 20px;
            cursor: pointer;
        }

        .pop i {
            font-size: 50px;
        }

        .pop span {
            font-size: 19px;
        }

        .showw {
            transform: scale(1);
        }

        .stop-scrolling {
            height: 100%;
            overflow: hidden;
        }
    </style>
    <div class="pop-cont">
        <div class="pop">
            <div class="fas fa-x"></div>
            <span><?php echo $_SESSION['done']; ?></span>
            <i class="fas fa-check-circle"></i>
        </div>
    </div>
    <!-- helpline form close -->
    <br><br>
    <!-- Footer start -->
    <?php
    include('./footer.php')
    ?>
    <!-- Footer end -->
    <script>
        function rep(name) {
            let n = name.replace(/^.*\\/, "");
            return n;
        };

        function getname1(name) {
            $('#file1').html(rep(name));
        }

        let popp = document.querySelector('.pop-cont'),
            x = document.querySelector('.fa-x');
        <?php
        if (isset($_SESSION['done'])) {
        ?>
            popp.classList.add('showw');
            $('body').addClass('stop-scrolling');
        <?php
            unset($_SESSION['done']);
        }
        ?>
        x.addEventListener('click', () => {
            popp.classList.remove('showw');
            $('body').removeClass('stop-scrolling');
        })
    </script>
</body>

</html>