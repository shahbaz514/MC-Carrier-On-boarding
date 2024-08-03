<?php
ob_start();
session_start();
include "db/db.php";
include "inc/head.php";
?>
    <section>
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>CARRIER LOGIN</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>CARRIER LOGIN</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <label for="email_address">Enter your MC#:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="mc_no" class="form-control" placeholder="Enter your MC#" required>
                                            </div>
                                        </div>
                                        <label for="email_address">Your Password:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="ein_no" class="form-control" placeholder="Enter your Password" required>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-block btn-primary m-t-15 waves-effect" name="login_now" value="Login Now">
                                    </form>
                                    <?php

                                    if (isset($_POST['login_now']))
                                    {
                                        $mc_no = mysqli_real_escape_string($db, $_POST['mc_no']);
                                        $ein_no = mysqli_real_escape_string($db, $_POST['ein_no']);

                                        $sqlCountData = 0;
                                        $sqlCountData = mysqli_num_rows(mysqli_query($db, "SELECT * FROM carrierprofile WHERE mcno = '$mc_no' AND password = '$ein_no' AND status_otp = 'Verified'"));
                                        if ($sqlCountData > 0) {
                                            $sqCa = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM carrierprofile WHERE mcno = '$mc_no'"));
                                            $_SESSION['carrier_id'] = $mc_no;
                                            $_SESSION['role'] = 'carrier';
                                            $_SESSION['status'] = $sqCa['status'];
                                            echo "<script>window.open('carrier/index.php','_self')</script>";
                                        }
                                        else {
                                            ?>
                                            <div class="alert bg-red alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                Take an Error! Try Again.
                                            </div>
                                            <center>
                                                <a href="index.php" class="btn btn-primary btn-warning">
                                                    Go To Home Page
                                                </a>
                                            </center>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





<?php
include "inc/footer.php";
?>