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
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `factory_info` WHERE carrier_id = '".$_GET['edit']."'"));
?>
    <section>
        <?php include 'inc/sidebar.php'; ?>
    </section>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>FACTORING</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>FACTORING</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="checkbox" id="md_checkbox_26" name="no_need" value="Yes" class="filled-in chk-col-blue"/>
                                                        <label for="md_checkbox_26">Check here if you DO NOT want to use a Factoring Company</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter Factoring Company Name:
                                                        </label>
                                                        <input type="text" name="fc_name" value="<?php echo @$getSql['fc_name']; ?>" class="form-control" placeholder="Factoring Company Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter Company Phone:
                                                        </label>
                                                        <input type="text" pattern="\d*" maxlength="10" name="fc_company_phone" value="<?php echo @$getSql['fc_company_phone']; ?>" class="form-control" placeholder="Company Phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter Remit Address:
                                                        </label>
                                                        <input type="text" name="fc_remit_address" value="<?php echo @$getSql['fc_remit_address']; ?>" class="form-control" placeholder="FC Remit Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Select City:
                                                        </label>
                                                        <select class="form-control show-tick" name="fc_city" data-live-search="true">
                                                            <option value="">-- Please City --</option>
                                                            <?php
                                                            $sqlCity = mysqli_query($db, "SELECT * FROM `cities` ORDER BY name ASC");
                                                            while($rowCity = mysqli_fetch_array($sqlCity))
                                                            {
                                                                echo "<option style='margin-left: 25px;'>".$rowCity['name']."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Select State:
                                                        </label>
                                                        <select class="form-control show-tick" name="fc_state" data-live-search="true">
                                                            <option value="">-- Please State --</option>
                                                            <?php
                                                            $sqlState = mysqli_query($db, "SELECT * FROM `states` ORDER BY name ASC");
                                                            while($rowState = mysqli_fetch_array($sqlState))
                                                            {
                                                                echo "<option style='margin-left: 25px;'>".$rowState['name']."</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter Zipcode:
                                                        </label>
                                                        <input type="text" pattern="\d*" maxlength="5" name="fc_zipcode" value="<?php echo @$getSql['fc_zipcode']; ?>" class="form-control" placeholder="Enter Zipcode">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter Contact:
                                                        </label>
                                                        <input type="text" name="fc_contact" value="<?php echo @$getSql['fc_contact']; ?>" class="form-control" placeholder="Enter Contact">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter Phone:
                                                        </label>
                                                        <input type="text" pattern="\d*" maxlength="10" name="fc_phone" value="<?php echo @$getSql['fc_phone']; ?>" class="form-control" placeholder="Enter Phone">
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
                                        $getDataRows = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `factory_info` WHERE carrier_id = '".$_GET['edit']."'"));
                                        if (isset($_POST['no_need']) && $_POST['no_need'] == 'Yes')
                                        {
                                            if ($getDataRows>0)
                                            {
                                                $sqlCountData = mysqli_query($db, "UPDATE `factory_info` SET no_need = 'Yes' WHERE carrier_id = '".$_GET['edit']."'");
                                            }
                                            else
                                            {
                                                $sqlCountData = mysqli_query($db, "INSERT INTO `factory_info`(`carrier_id`, `no_need`) VALUES ('".$_GET['edit']."', 'Yes')");
                                            }


                                            if ($sqlCountData) {
                                                echo "<script>window.open('mutualconcepts.v3.php','_self')</script>";
                                            }
                                        }
                                        else
                                        {

                                            if ($getDataRows>0)
                                            {
                                                $sqlCountData = mysqli_query($db, "UPDATE `factory_info` SET `fc_name`='".$_POST['fc_name']."',`fc_company_phone`='".$_POST['fc_company_phone']."',`fc_remit_address`='".$_POST['fc_remit_address']."',`fc_city`='".$_POST['fc_city']."',`fc_state`='".$_POST['fc_state']."',`fc_zipcode`='".$_POST['fc_zipcode']."',`fc_contact`='".$_POST['fc_contact']."',`fc_phone`='".$_POST['fc_phone']."' WHERE carrier_id = '".$_GET['edit']."'");
                                            }
                                            else
                                            {
                                                $sqlCountData = mysqli_query($db, "INSERT INTO `factory_info`(`carrier_id`, `fc_name`, `fc_company_phone`, `fc_remit_address`, `fc_city`, `fc_state`, `fc_zipcode`, `fc_contact`, `fc_phone`) VALUES ('".$_GET['edit']."', '".$_POST['fc_name']."', '".$_POST['fc_company_phone']."', '".$_POST['fc_remit_address']."', '".$_POST['fc_city']."', '".$_POST['fc_state']."', '".$_POST['fc_zipcode']."', '".$_POST['fc_contact']."', '".$_POST['fc_phone']."')");
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