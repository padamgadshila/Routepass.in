<?php
require_once './connect.php';

if (isset($_GET['pass_id'])) {
    $pid = $_GET['pass_id'];
    $select = mysqli_query($conn, "SELECT * FROM `pass` WHERE `pass_id` ='$pid'");
    $pass = mysqli_fetch_assoc($select);
    $select = mysqli_query($conn, "SELECT * FROM `route` WHERE `pid` ='$pid'");
    if (mysqli_num_rows($select) > 0) {
        $route = mysqli_fetch_assoc($select);
    } else {
        $blank = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="./css/apply.css">
    <style>
        .form-container {
            height: auto;
        }

        .btn-container {
            margin-left: 40%;
        }

        @media (max-width:400px) {
            .form-container {
                height: 100vh;
            }

            .btn-container {
                margin-left: 30%;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="./update_confirm.php" method="post" class="form" id="form">
            <div class="page1">
                <h2>Update Information</h2>
                <div class="input-container">
                    <div class="input">
                        <label class="title">First Name</label>
                        <input type="number" name="id" value="<?php echo $pass['pass_id']; ?>" hidden>
                        <input type="text" name="fname" placeholder="First Name" value="<?php echo $pass['fname']; ?>" required>
                    </div>
                    <div class="input">
                        <label class="title">Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" value="<?php echo $pass['lname']; ?>" required>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <label class="title">Birthday</label>
                        <input type="date" name="dob" placeholder="dob" value="<?php echo $pass['dob']; ?>" required>
                    </div>
                    <div class="input">
                        <label class="title">Mobile</label>
                        <input type="number" name="mobile" value="<?php echo $pass['mobile']; ?>" placeholder="Number" required>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <label class="title">Email</label>
                        <input type="email" name="email" value="<?php echo $pass['email']; ?>" placeholder="Email" required>
                    </div>
                    <div class="input">
                        <label class="title">Pass type</label>
                        <select name="pass_type" id="passs">
                            <option>Select</option>
                            <option value="Full" <?php if ($pass['pass_type'] == 'Full') echo "selected" ?>>Full</option>
                            <option value="Punching" <?php if ($pass['pass_type'] == 'Punching') echo "selected" ?>>Punching</option>
                        </select>
                    </div>
                </div>
                <h2 id="toHide">Enter your Destination</h2>
                <div class="input-container" id="toHide2">
                    <div class="input">
                        <label class="title">Start</label>
                        <input type="text" name="start" value="<?php if (isset($blank)) echo $blank;
                                                                else echo $route['start']; ?>" placeholder="Start" id="req" required>
                    </div>
                    <div class="input">
                        <label class="title">Stop</label>
                        <input type="text" name="stop" value="<?php if (isset($blank)) echo $blank;
                                                                else echo $route['stop']; ?>" placeholder="Stop" id="req2" required>
                    </div>
                </div>
                <div class="btn-container">
                    <button name="update">Update</button>
                </div>
            </div>
    </div>
    </form>
    </div>
    <script>
        let pass_type = document.querySelector('#passs'),
            hide = document.getElementById('toHide'),
            hide2 = document.getElementById('toHide2'),
            req = document.getElementById('req'),
            req2 = document.getElementById('req2');

        window.addEventListener('load', () => {
            let pt = pass_type.value;
            if (pt === "Full") {
                console.log(pt);
                hide.style.display = 'none';
                hide2.style.display = 'none';
                req.removeAttribute('required');
                req2.removeAttribute('required');
            } else {
                hide.style.display = '';
                hide2.style.display = '';
                req.setAttribute('required', 'required');
                req2.setAttribute('required', 'required');
            }
        });
        pass_type.addEventListener('change', () => {
            let pt = pass_type.value;
            if (pt === "Full") {
                console.log(pt);
                hide.style.display = 'none';
                hide2.style.display = 'none';
                req.removeAttribute('required');
                req2.removeAttribute('required');
            } else {
                hide.style.display = '';
                hide2.style.display = '';
                req.setAttribute('required', 'required');
                req2.setAttribute('required', 'required');
            }
        });
    </script>
</body>

</html>