<?php
require_once './connect.php';
if (empty($_SESSION['admin'])) {
    header('location:admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="./fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <div class="fas fa-arrow-right"></div>
    <nav class="nav">
        <ul>
            <li>
                <a href="index.php" class="logo">
                    <img src="./images/favicon.jpg">
                    <img src="./images/logo.png">
                </a>
            </li>
            <li>
                <a href="#home">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Home</span>
                </a>
            </li>
            <li>
                <a href="#profile">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>
                </a>
            </li>
            <li>
                <a href="#wallete">
                    <i class="fas fa-wallet"></i>
                    <span class="nav-item">Wallet</span>
                </a>
            </li>
            <li>
                <a href="#tasks">
                    <i class="fas fa-tasks"></i>
                    <span class="nav-item">Tasks</span>
                </a>
            </li>
            <li>
                <a href="#settings">
                    <i class="fas fa-cog"></i>
                    <span class="nav-item">Settings</span>
                </a>
            </li>
            <li>
                <a href="#help">
                    <i class="fas fa-question-circle"></i>
                    <span class="nav-item">Help</span>
                </a>
            </li>
            <li>
                <a href="./Admin-logout.php" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Logout</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Sections start -->
    <div class="main">
        <section id="home">
            <?php
            $select         = mysqli_query($conn, "SELECT * FROM `users`");
            $totalUsesr     = mysqli_num_rows($select);
            $select         = mysqli_query($conn, "SELECT * FROM `pass`");
            $totalPass      = mysqli_num_rows($select);
            $select         = mysqli_query($conn, "SELECT * FROM `pass` WHERE `gender`='Male'");
            $totalMen       = mysqli_num_rows($select);
            $select         = mysqli_query($conn, "SELECT * FROM `pass` WHERE `gender`='Female'");
            $totalFemale    = mysqli_num_rows($select);
            $select         = mysqli_query($conn, "SELECT * FROM `pass` WHERE `duration`='1-month'");
            $totalD1        = mysqli_num_rows($select);
            $select         = mysqli_query($conn, "SELECT * FROM `pass` WHERE `duration`='3-month'");
            $totalD3        = mysqli_num_rows($select);
            $select         = mysqli_query($conn, "SELECT * FROM `pass` WHERE `pass_type`='FULL'");
            $totalFRP       = mysqli_num_rows($select);
            $select         = mysqli_query($conn, "SELECT * FROM `pass` WHERE `pass_type`='Punching'");
            $totalPP        = mysqli_num_rows($select);

            ?>
            <div class="infoma">
                <h2>Users</h2>
                <div class="row">
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-users ic"></i>
                            <div class="info">
                                <b><?php echo $totalUsesr; ?></b>
                                <span>Users</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-user ic"></i>
                            <div class="info">
                                <b><?php echo $totalMen; ?></b>
                                <span>Males</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-user ic"></i>
                            <div class="info">
                                <b><?php echo $totalFemale; ?></b>
                                <span>Females</span>
                            </div>
                        </div>
                    </div>
                </div>
                <h2>Pass</h2>
                <div class="row">
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-chart-bar ic"></i>
                            <div class="info">
                                <b><?php echo $totalPass; ?></b>
                                <span>Total Pass</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-book ic"></i>
                            <div class="info">
                                <b><?php echo $totalFRP; ?></b>
                                <span>Full Route</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-book ic"></i>
                            <div class="info">
                                <b><?php echo $totalPP; ?></b>
                                <span>Punching</span>
                            </div>
                        </div>
                    </div>
                </div>
                <h2>Pass months</h2>
                <div class="row">
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-clock ic"></i>
                            <div class="info">
                                <b><?php echo $totalD1; ?></b>
                                <span>1-Month</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-clock ic"></i>
                            <div class="info">
                                <b><?php echo $totalD3; ?></b>
                                <span>3-Month</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $today      = 0;
                $month      = 0;
                $year       = 0;
                $count      = mysqli_query($conn, "SELECT * FROM `plan` where `issue` = CURRENT_DATE");
                $today      += mysqli_num_rows($count);
                $count      = mysqli_query($conn, "SELECT * FROM `plan` where month(`issue`) = month(CURRENT_DATE)");
                $month      += mysqli_num_rows($count);
                $count      = mysqli_query($conn, "SELECT * FROM `plan` where year(`issue`) = year(CURRENT_DATE)");
                $year       += mysqli_num_rows($count);
                // SELECT count(`plan_id`) FROM `plan` where month(issue) = month(CURRENT_DATE); 
                // SELECT count(`plan_id`) FROM `plan` where year(issue) = year(CURRENT_DATE); 
                ?>
                <h2>Status</h2>
                <div class="row">
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-tasks ic"></i>
                            <div class="info">
                                <b><?php echo $today; ?></b>
                                <span>Today</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-tasks ic"></i>
                            <div class="info">
                                <b><?php echo $month; ?></b>
                                <span>This Month</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="score">
                            <i class="fas fa-tasks ic"></i>
                            <div class="info">
                                <b><?php echo $year; ?></b>
                                <span>This Year</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section id="profile">
                <div class="table-cont">
                    <div class="tables">
                        <h2>Users</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>User id</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Mobile no</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = mysqli_query($conn, "SELECT*FROM `users`");
                                while ($users = mysqli_fetch_assoc($select)) {
                                ?>
                                    <tr>
                                        <td><?php echo $users['user_id']; ?></td>
                                        <td><?php echo $users['fname']; ?></td>
                                        <td><?php echo $users['lname']; ?></td>
                                        <td><?php echo $users['email']; ?></td>
                                        <td><?php echo $users['mobile']; ?></td>
                                        <td><a href="./edit.php?user_id=<?php echo $users['user_id']; ?>" id="edit">Edit</a></td>
                                        <td><a href="./delete.php?user_id=<?php echo $users['user_id']; ?>" id="del">Delete</a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tables">
                        <h2>Pass</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Pass id</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Date of birth</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Mobile no</th>
                                    <th>User pic</th>
                                    <th>College id</th>
                                    <th>Aadhar card</th>
                                    <th>Bonofide</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Pincode</th>
                                    <th>Pass type</th>
                                    <th>Months</th>
                                    <th>Qr-code</th>
                                    <th>User id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = mysqli_query($conn, "SELECT*FROM `pass`");
                                $select2 = mysqli_query($conn, "SELECT `email`  from `users`");
                                while ($users = mysqli_fetch_assoc($select2)) {
                                    while ($pass = mysqli_fetch_assoc($select)) {
                                ?>
                                        <tr>
                                            <td><?php echo $pass['pass_id']; ?></td>
                                            <td><?php echo $pass['fname']; ?></td>
                                            <td><?php echo $pass['lname']; ?></td>
                                            <td><?php echo $pass['dob']; ?></td>
                                            <td><?php echo $pass['gender']; ?></td>
                                            <td><?php echo $pass['email']; ?></td>
                                            <td><?php echo $pass['mobile']; ?></td>
                                            <td><img src="<?php echo 'img/' . $users['email'] . '/' . $pass['user_pic']; ?>" alt=""></td>
                                            <td><img src="<?php echo 'img/' . $users['email'] . '/' . $pass['college_id']; ?>" alt=""></td>
                                            <td><img src="<?php echo 'img/' . $users['email'] . '/' . $pass['aadhar_card']; ?>" alt=""></td>
                                            <td><img src="<?php echo 'img/' . $users['email'] . '/' . $pass['bonofide']; ?>" alt=""></td>
                                            <td><?php echo $pass['state']; ?></td>
                                            <td><?php echo $pass['city']; ?></td>
                                            <td><?php echo $pass['zipcode']; ?></td>
                                            <td><?php echo $pass['pass_type']; ?></td>
                                            <td><?php echo $pass['duration']; ?></td>
                                            <td><img src="<?php $qr = str_replace('admin/', '', $pass['qrcodes']);
                                                            echo $qr; ?>" alt=""></td>
                                            <td><?php echo $pass['uid']; ?></td>
                                            <td><a href="./delete.php?pass_id=<?php echo $pass['pass_id']; ?>" id="del">Delete</a></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tables">
                        <h2>Plan</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Plan id</th>
                                    <th>Issue Date</th>
                                    <th>Renew Date</th>
                                    <th>Pass id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = mysqli_query($conn, "SELECT*FROM `plan`");
                                while ($plan = mysqli_fetch_assoc($select)) {
                                ?>
                                    <tr>
                                        <td><?php echo $plan['plan_id']; ?></td>
                                        <td><?php echo $plan['issue']; ?></td>
                                        <td><?php echo $plan['renew']; ?></td>
                                        <td><?php echo $plan['pid']; ?></td>
                                        <td><a href="./delete.php?plan_id=<?php echo $plan['plan_id']; ?>" id="del">Delete</a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tables">
                        <h2>Route</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Route id</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Pass id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = mysqli_query($conn, "SELECT*FROM `route`");
                                while ($route = mysqli_fetch_assoc($select)) {
                                ?>
                                    <tr>
                                        <td><?php echo $route['rout_id']; ?></td>
                                        <td><?php echo $route['start']; ?></td>
                                        <td><?php echo $route['stop']; ?></td>
                                        <td><?php echo $route['pid']; ?></td>
                                        <td><a href="./delete.php?rout_id=<?php echo $route['rout_id']; ?>" id="del">Delete</a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tables">
                        <h2>Quereis</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Query id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Screenshot</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = mysqli_query($conn, "SELECT*FROM `query`");
                                while ($query = mysqli_fetch_assoc($select)) {
                                ?>
                                    <tr>
                                        <td><?php echo $query['qid']; ?></td>
                                        <td><?php echo $query['name']; ?></td>
                                        <td><?php echo $query['email']; ?></td>
                                        <td><?php echo $query['message']; ?></td>
                                        <td><img src="<?php echo 'img/query/' . $query['email'] . '/' . $query['messagepic']; ?>"></td>
                                        <td><a href="./delete.php?qid=<?php echo $query['qid']; ?>" id="del">Delete</a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section id="wallete">Wallete</section>
            <section id="analyis">Analyisis</section>
            <section id="tasks">Tasks</section>
            <section id="settings">Settings</section>
            <section id="help">Help</section>
    </div>

    <!-- Sections end -->
    <script>
        let btn = document.querySelector('.fa-arrow-right'),
            nav = document.querySelector('.nav'),
            section = document.querySelector('.main');

        btn.addEventListener('click', () => {
            btn.classList.toggle('active');
            nav.classList.toggle('nav-slide');
        });
        section.addEventListener('click', () => {
            btn.classList.remove('active');
            nav.classList.remove('nav-slide');
        });

        let width = window.innerWidth;
        if (width == "360") {
            btn.addEventListener('click', () => {
                btn.classList.toggle('active2');
                nav.classList.toggle('nav-s');
            });
            section.addEventListener('click', () => {
                btn.classList.remove('active2');
                nav.classList.remove('nav-s');
            });
        }
    </script>
</body>

</html>