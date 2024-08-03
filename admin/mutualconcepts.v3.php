<?php
ob_start();
session_start();
include "../db/db.php";
include "inc/head.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}

if ($_SESSION['role'] == 'Dispatch')
{
    echo "<script>alert('You are Not Authorized to Edit Carrier Profile.')</script>";
    echo "<script>window.open('allCarrier.php','_self')</script>";
}
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `insurance_info` WHERE carrier_id = '".$_GET['edit']."'"));
?>
    <section>
        <?php include 'inc/sidebar.php'; ?>
    </section>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>INSURANCE COMPANY</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>INSURANCE COMPANY</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Insurance Agency Name:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="ic_name" value="<?php echo @$getSql['ic_name']; ?>"  class="form-control" placeholder="Insurance Agency Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Phone:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" pattern="\d*" maxlength="10" name="ic_phone" value="<?php echo @$getSql['ic_phone']; ?>"  class="form-control" placeholder="Phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Contact:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" pattern="\d*" name="ic_contact" value="<?php echo @$getSql['ic_contact']; ?>"  class="form-control" placeholder="Enter Contact" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Email:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="email" name="ic_email" value="<?php echo @$getSql['ic_email']; ?>"  class="form-control" placeholder="Enter Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Policy No#:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="ic_policy_no" value="<?php echo @$getSql['ic_policy_no']; ?>"  class="form-control" placeholder="Enter Policy Number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Insurance Expiry Number:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="date" name="ic_expiery_date" value="<?php echo @$getSql['ic_expiery_date']; ?>"  class="form-control" placeholder="Enter Expiration Date" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn bg-blue waves-effect" name="save" value="Go to Next Step">
                                    </form>
                                    <?php

                                    if (isset($_POST['save']))
                                    {
                                        $getDataRows = 0;
                                        $getDataRows = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `insurance_info` WHERE carrier_id = '".$_GET['edit']."'"));
                                        if ($getDataRows>0)
                                        {
                                            $sqlCountData = mysqli_query($db, "UPDATE `insurance_info` SET `ic_name`='".$_POST['ic_name']."',`ic_phone`='".$_POST['ic_phone']."',`ic_contact`='".$_POST['ic_contact']."',`ic_email`='".$_POST['ic_email']."',`ic_policy_no`='".$_POST['ic_policy_no']."',`ic_expiery_date`='".$_POST['ic_expiery_date']."' WHERE carrier_id = '".$_GET['edit']."'");
                                        }
                                        else
                                        {
                                            $sqlCountData = mysqli_query($db, "INSERT INTO `insurance_info`(`carrier_id`, `ic_name`, `ic_phone`, `ic_contact`, `ic_email`, `ic_policy_no`, `ic_expiery_date`) VALUES ('".$_GET['edit']."', '".$_POST['ic_name']."', '".$_POST['ic_phone']."', '".$_POST['ic_contact']."', '".$_POST['ic_email']."', '".$_POST['ic_policy_no']."', '".$_POST['ic_expiery_date']."')");
                                        }

                                        if ($sqlCountData) {
                                            echo "<script>window.open('viewData.php?view=".$_GET['edit']."','_self')</script>";
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