<?php
require_once './connect.php';
//If session['email'] is empty then redirect them to login page...
if (empty($_SESSION['email'])) {
    header('location: login.php');
}

$email_  = $_SESSION['email'];
$id      = $_SESSION['uid'];
$query   = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email_'");
$row     = mysqli_fetch_assoc($query);
$select  = mysqli_query($conn, "SELECT * FROM `pass` WHERE `uid` ='$id'");
// if (mysqli_num_rows($select) > 0) {
//     header('location:index.php');
// }
if (isset($_POST['apply'])) {
    $fname      = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname      = mysqli_real_escape_string($conn, $_POST['lname']);
    $dob        = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $number     = mysqli_real_escape_string($conn, $_POST['mobile']);
    $state      = mysqli_real_escape_string($conn, $_POST['state']);
    $city       = mysqli_real_escape_string($conn, $_POST['city']);
    $zipcode    = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $pass_type  = mysqli_real_escape_string($conn, $_POST['pass_type']);
    $start      = mysqli_real_escape_string($conn, $_POST['start']);
    $stop       = mysqli_real_escape_string($conn, $_POST['stop']);
    $duration   = mysqli_real_escape_string($conn, $_POST['duration']);

    // Storing image name
    $user_pic   = $_FILES['user_pic']['name'];
    $college_id = $_FILES['college_id']['name'];
    $aadhar     = $_FILES['aadhar_card']['name'];
    $bonofide   = $_FILES['bonofide']['name'];
    //storing temp name of image
    // $user_pic_temp      =
    //     $college_id_temp    = ;
    // $aadhar_temp        = ;
    // $bonofide_temp      = ;

    //defining location to store the pics
    mkdir("admin/img/$email");
    $user   = "admin/img/$email/" . $user_pic;
    $col    = "admin/img/$email/" . $college_id;
    $bono   = "admin/img/$email/" . $bonofide;
    $ad     = "admin/img/$email/" . $aadhar;
    //moving the images to those location
    move_uploaded_file($_FILES['user_pic']['tmp_name'], $user);
    move_uploaded_file($_FILES['college_id']['tmp_name'], $col);
    move_uploaded_file($_FILES['aadhar_card']['tmp_name'], $bono);
    move_uploaded_file($_FILES['bonofide']['tmp_name'], $ad);
    //Creating the qrcode for the user
    require_once 'phpqrcode/qrlib.php';
    $path = "admin/img/$email/";
    $qrcode = $path . time() . ".png";
    QRcode::png('uid = ' . $id . ', name = ' . $fname . ' ' . $lname, $qrcode, 'H', 4, 4);

    $insert = mysqli_query($conn, "INSERT INTO `pass`(`fname`,`lname`,`dob`,`gender`,`email`,`mobile`,`user_pic`,`college_id`,`aadhar_card`,`bonofide`,`state`,`city`,`zipcode`,`pass_type`,`duration`,`qrcodes`,`uid`) VALUES('$fname','$lname','$dob','$gender','$email','$number','$user_pic','$college_id','$aadhar','$bonofide','$state','$city','$zipcode','$pass_type','$duration','$qrcode','$id')");
    $select = mysqli_query($conn, "SELECT * FROM `pass` WHERE `uid` ='$id'");
    $row    = mysqli_fetch_assoc($select);
    $pid    = $row['pass_id'];

    if ($pass_type != 'Full') {
        $insert = mysqli_query($conn, "INSERT INTO `route`(`start`,`stop`,`pid`) VALUES('$start','$stop','$pid')");
    }
    $insert = mysqli_query($conn, "INSERT INTO `plan`(`issue`,`pid`)VALUES(NOW(),'$pid')");
    $select = mysqli_query($conn, "SELECT * FROM `plan` where `pid` = '$pid '");
    $row    = mysqli_fetch_assoc($select);
    $old_date = $row['issue'];
    if ($duration === '1-month') {
        $update = mysqli_query($conn, "UPDATE `plan` set `renew` = addDate('$old_date',INTERVAL 1 month) where `pid` = '$pid'");
    } else {
        $update = mysqli_query($conn, "UPDATE `plan` set `renew` = addDate('$old_date',INTERVAL 3 Month) where `pid` = '$pid'");
    }
    header('location: payment.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    <link rel="stylesheet" href="./css/apply.css">
    <script src="./js/jquery.min.js"></script>
</head>

<body>
    <div class="blur">
        <img src="./images/route-loading.gif">
        <span>Please wait...</span>
    </div>
    <div class="form-container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" class="form" id="form">
            <div class="page1">
                <h2>Personal Information</h2>
                <div class="input-container">
                    <div class="input">
                        <label class="title">First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="input">
                        <label class="title">Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <label class="title">Birthday</label>
                        <input type="date" name="dob" placeholder="dob" required>
                    </div>
                    <div class="input">
                        <label class="title">Gender</label>
                        <select name="gender" id="gen">
                            <option>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <label class="title">Email</label>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input">
                        <label class="title">Mobile</label>
                        <input type="number" name="mobile" placeholder="Number" required>
                    </div>
                </div>
                <h2>Documents</h2>
                <div class="input-container">
                    <div class="input">
                        <label class="title">Your Photo</label>
                        <input type="file" name="user_pic" id="photo" hidden onchange="getname1(this.value)" required>
                        <label for="photo" class="file">
                            <p id="file1">No file selected</p>
                        </label>
                    </div>
                    <div class="input">
                        <label class="title">College Id</label>
                        <input type="file" name="college_id" id="cid" hidden onchange="getname2(this.value)" required>
                        <label for="cid" class="file">
                            <p id="file2">No file selected</p>
                        </label>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <label class="title">Addhar Card</label>
                        <input type="file" name="aadhar_card" id="addhar" hidden onchange="getname3(this.value)" required>
                        <label for="addhar" class="file">
                            <p id="file3">No file selected</p>
                        </label>
                    </div>
                    <div class="input">
                        <label class="title">Bonofide</label>
                        <input type="file" name="bonofide" id="bono" hidden onchange="getname4(this.value)" required>
                        <label for="bono" class="file">
                            <p id="file4">No file selected</p>
                        </label>
                    </div>
                </div>
                <div class="btn-container">
                    <button id="next">Next</button>
                </div>

            </div>
            <div class="page2">

                <h2>Address</h2>
                <div class="input-container">
                    <div class="input">
                        <label class="title">State</label>
                        <input type="text" name="state" placeholder="State" required>
                    </div>
                    <div class="input">
                        <label class="title">City</label>
                        <input type="text" name="city" placeholder="City" required>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <label class="title">Zipcode</label>
                        <input type="number" name="zipcode" placeholder="Zipcode" required>
                    </div>
                    <div class="input"></div>
                </div>
                <h2>Select pass types</h2>
                <div class="input-container">
                    <div class="input">
                        <label class="title">Pass type</label>
                        <select name="pass_type" id="passs">
                            <option>Select</option>
                            <option value="Full">Full</option>
                            <option value="Punching">Punching</option>
                        </select>
                    </div>
                    <div class="input">
                        <label class="title">Duration</label>
                        <select name="duration" id="dura">
                            <option>Select</option>
                            <option value="1-month">1 Month</option>
                            <option value="3-month">3 Month</option>
                        </select>
                    </div>
                </div>

                <h2 id="toHide">Enter your Destination</h2>

                <div class="input-container" id="toHide2">
                    <div class="input">
                        <label class="title">Start</label>
                        <input type="text" name="start" placeholder="Start" id="req" required>
                    </div>
                    <div class="input">
                        <label class="title">Stop</label>
                        <input type="text" name="stop" placeholder="Stop" id="req2" required>
                    </div>
                </div>

                <div class="btn-container">
                    <button id="prev">Prev</button>
                    <button id="apps" name="apply">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function rep(name) {
            let n = name.replace(/^.*\\/, "");
            return n;
        };

        function getname1(name) {
            $('#file1').html(rep(name));
        }

        function getname2(name) {
            $('#file2').html(rep(name));
        }

        function getname3(name) {
            $('#file3').html(rep(name));
        }

        function getname4(name) {
            $('#file4').html(rep(name));
        }
        let $page = $('.page1');
        let $next = $('#next');
        let $prev = $('#prev');

        $next.click(() => {
            $page.css('marginLeft', '-100%');
        });
        $prev.click(() => {
            $page.css('marginLeft', '-0%');
        });

        let pass_type = document.querySelector('#passs'),
            hide = document.getElementById('toHide'),
            hide2 = document.getElementById('toHide2'),
            req = document.getElementById('req'),
            req2 = document.getElementById('req2');
        let pt = pass_type.value;
        if (pt == "Select") {
            pass_type.style.border = "2px solid red";
        }
        pass_type.addEventListener('change', () => {
            if (pass_type.value === "Select") {
                pass_type.style.border = "2px solid red";
            } else if (pass_type.value === "Full") {
                pass_type.style.border = "";
                console.log(pass_type.value);
                hide.style.display = 'none';
                hide2.style.display = 'none';
                req.removeAttribute('required');
                req2.removeAttribute('required');
            } else {
                pass_type.style.border = "";
                hide.style.display = '';
                hide2.style.display = '';
                req.setAttribute('required', 'required');
                req2.setAttribute('required', 'required');
            }
        });

        //validating all info is filled...
        let bnt3 = document.getElementById('apps'),
            bnt2 = document.getElementById('prev'),
            bnt1 = document.getElementById('next'),
            blur = document.querySelector('.blur'),
            dura = document.getElementById('dura'),
            i = 0;

        bnt1.addEventListener('click', () => {
            i++;
            console.log('clicked = ' + i);
        });
        bnt2.addEventListener('click', () => {
            i--;
            console.log('clicked = ' + i);
        });

        dura.addEventListener('change', () => {
            let duration = dura.value;
            if (duration == '1-month') {
                bnt3.addEventListener('click', () => {
                    if (i == 1) {
                        blur.classList.add('blur-pop');
                    } else {
                        alert('Please fill all details.');
                    }
                });
            } else {
                bnt3.addEventListener('click', () => {
                    if (i == 1) {
                        blur.classList.add('blur-pop');
                    } else {
                        alert('Please fill all details.');
                    }
                })
            }
        });

        let gen = document.getElementById('gen');
        if (gen.value == 'Select') {
            gen.style.border = "2px solid red";
        }
        gen.addEventListener('change', () => {
            if (gen.value == "Select") {
                gen.style.border = "2px solid red";
            } else {
                gen.style.border = "";
            }
        });

        if (dura.value == 'Select') {
            dura.style.border = "2px solid red";
        }
        dura.addEventListener('change', () => {
            if (dura.value == "Select") {
                dura.style.border = "2px solid red";
            } else {
                dura.style.border = "";
            }
        });
    </script>
</body>

</html>