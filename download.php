<?php
require_once './connect.php';

if (empty($_SESSION['email'])) {
    header('location: index.php');
} else {
    if (isset($_GET['pass_id'])) {
        $pid = $_GET['pass_id'];
        header('refresh:7;url=index.php');
        // header('location:index.php');
        $select = mysqli_query($conn, "SELECT * FROM `pass` WHERE `pass_id` ='$pid'");
        if (mysqli_num_rows($select) > 0) {
            $pass   = mysqli_fetch_assoc($select);
            $select = mysqli_query($conn, "SELECT * FROM `route` WHERE `pid` ='$pid'");
            if (mysqli_num_rows($select) > 0) {
                $route = mysqli_fetch_assoc($select);
            } else {
                $blank = '-';
            }
            $select = mysqli_query($conn, "SELECT * FROM `plan` WHERE `pid` ='$pid'");
            $plan   = mysqli_fetch_assoc($select);
        } else {
            header('location:404.html');
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $pass['fname'] . ' ' . $pass['lname'] ?> - Pass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- html2pdf CDN link -->
    <script src="./js/html2pdf.bundle.min.js"></script>
    <link rel="shortcut icon" href="./images/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="./css/pdf-download.css">
</head>

<body>
    <div id="invoice">
        <?php
        if (isset($blank)) {
        ?>
            <div class="blank rl" style="display:block"></div>
        <?php
        } else {
        ?>
            <div class="blank rl" style="display:none"></div>
        <?php
        }
        ?>
        <div class="pass-img">
            <img src="./images/Final-Pass.png">
        </div>
        <div class="pid rl">
            <p>Pass no: <span><?php echo $pass['pass_id']; ?></span></p>
        </div>
        <div class="logo rl">
            <img src="./images/logo.png">
        </div>
        <div class="pic rl">

            <img src="<?php echo 'admin/img/' . $pass['email'] . '/' . $pass['user_pic']; ?>">
        </div>
        <div class="qrocde rl">
            <img src="<?php echo  $pass['qrcodes']; ?>" alt="">
        </div>
        <div class="sign rl">
            <p>Applicant's Sign</p>
        </div>
        <div class="sign2 rl">
            <p>Officer's Sign</p>
        </div>
        <div class="stamp rl">
            <b>STAMP</b>
            <img src="./images/stamp.png">
        </div>
        <div class="name rl">
            <p>Name: <span><?php echo $pass['fname'] . " " . $pass['lname']; ?></span></p>
        </div>
        <div class="number rl">
            <p>Contact no: <span><?php echo $pass['mobile'] ?></span></p>
        </div>
        <div class="email rl">
            <p>Email: <span><?php echo $pass['email'] ?></span></p>
        </div>
        <div class="from rl">
            <p>From:
                <span><?php
                        if (isset($blank)) {
                            echo $blank;
                        } else {
                            echo $route['start'];
                        } ?>
                </span>
            </p>
        </div>
        <div class="to rl">
            <p>To:
                <span><?php
                        if (isset($blank)) {
                            echo $blank;
                        } else {
                            echo $route['stop'];
                        } ?>
                </span>
            </p>
        </div>
        <div class="issue rl">
            <p>Issue Date: <span><?php echo $plan['issue']; ?></span></p>
        </div>
        <div class="renew rl">
            <p>Renew Date: <span><?php echo $plan['renew']; ?></span></p>
        </div>
    </div>

    <button id="download-button">Download PDF</button>


    <script>
        const button = document.getElementById('download-button');

        // let opt = {
        //     margin: [15, 0, 15, 0,],
        //     filename: `CV-${name}.pdf`,
        //     image: { type: 'jpeg', quality: 1 },
        //     html2canvas: {
        //         dpi: 192,
        //         scale: 4,
        //         letterRendering: true,
        //         useCORS: true
        //     },
        //     jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        // };

        let opt = {
            margin: 1,
            filename: "<?php echo $pass['fname'] . ' ' . $pass['lname'] ?>.pdf",
            image: {
                type: 'jpeg',
                quality: 1
            },
            html2canvas: {
                scale: 4
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        button.addEventListener('click', () => {
            // Choose the element that your content will be rendered to.
            const element = document.getElementById('invoice');
            // Choose the element and save the PDF for your user.
            html2pdf().set(opt).from(element).save();

        });
    </script>

</body>

</html>