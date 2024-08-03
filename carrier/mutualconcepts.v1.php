<?php
ob_start();
session_start();
include "../db/db.php";
include "inc/head.php";
if (!isset($_SESSION['carrier_id']))
{
    header("Location: ../carrierLogin.php");
}
if ($_SESSION['status'] == 'Completed')
{
    header("Location: viewSubmitedData.php");
}
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '" . $_SESSION['carrier_id'] . "'"));
$steps = $getSql['steps'];
$steps++;
if (!isset($_GET['edit'])) {
    if ($steps != '1') {
        header("Location: mutualconcepts.v" . $steps . ".php");
    }
}
?>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>CARRIER PROFILE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>CARRIER PROFILE</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Enter SCAC:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="scac" class="form-control" placeholder="Enter SCAC" value="<?php echo @$getSql['scac']; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter FED ID#:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="fedidno" class="form-control" value="<?php echo $getSql['fedidno']; ?>" placeholder="Enter Fed Id#" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Enter Phone:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" pattern="\d*" name="phone" class="form-control" maxlength="10" value="<?php echo $getSql['phone']; ?>" placeholder="Enter Phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Enter FAX:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="fax" class="form-control" value="<?php echo $getSql['fax']; ?>" placeholder="Enter Fax" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="display: none;">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Enter Email:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="email" name="email" class="form-control" value="<?php echo $getSql['email']; ?>" placeholder="Enter Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <h5><b>Remit to Mailing Address:</b> (if different from above)</h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter Street:
                                                        </label>
                                                        <input type="text" name="remitstreet" value="<?php echo $getSql['remitstreet']; ?>" class="form-control" placeholder="Enter Street">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Select City:
                                                        </label>
                                                        <select class="form-control show-tick" name="remitcity" data-live-search="true">
                                                            <option value="">-- Please Remit City --</option>
                                                            <?php
                                                            $sqlCity = mysqli_query($db, "SELECT * FROM `cities` ORDER BY name ASC");
                                                            while($rowCity = mysqli_fetch_array($sqlCity))
                                                            {
                                                                echo "<option style='margin-left: 20px;'>".$rowCity['name']."</option>";
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
                                                        <select class="form-control show-tick" name="remitstate" data-live-search="true">
                                                            <option value="">-- Please Remit State --</option>
                                                            <?php
                                                            $sqlState = mysqli_query($db, "SELECT * FROM `states` ORDER BY name ASC");
                                                            while($rowState = mysqli_fetch_array($sqlState))
                                                            {
                                                                echo "<option style='margin-left: 20px;'>".$rowState['name']."</option>";
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
                                                        <input type="text" pattern="\d*" maxlength="5" name="remitzipcode" value="<?php echo $getSql['remitzipcode']; ?>" class="form-control" placeholder="Enter Zip Code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <h5>
                                                    <b>Contact Information:</b>
                                                </h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Dispatcher:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="ci_dispatcher" value="<?php echo $getSql['ci_dispatcher']; ?>"  class="form-control" placeholder="Dispatcher" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Main Phone
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" pattern="\d*"  maxlength="10" name="ci_mainphone" value="<?php echo $getSql['ci_mainphone']; ?>"  class="form-control" placeholder="Main Phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            After Hours Cell or Night
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="ci_afterhour" value="<?php echo $getSql['ci_afterhour']; ?>"  class="form-control" placeholder="After Hours Cell or Night" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Enter Email:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="email" name="ci_email" value="<?php echo $getSql['ci_email']; ?>"  class="form-control" placeholder="Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Operations Manager:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="ci_operationamanager"  value="<?php echo $getSql['ci_operationamanager']; ?>" class="form-control" placeholder="Operations Manager" required>
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
                                                        <input type="text" pattern="\d*"  maxlength="10" name="ci_om_phone" value="<?php echo $getSql['ci_om_phone']; ?>"  class="form-control" placeholder="Phone" required>
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
                                                        <input type="email" name="ci_om_email" value="<?php echo $getSql['ci_om_email']; ?>"  class="form-control" placeholder="Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Accounts Payable Contact
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" maxlength="10" name="ci_accounts_payable_contact" value="<?php echo $getSql['ci_accounts_payable_contact']; ?>"  class="form-control" placeholder="Accounts Payable Contact" required>
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
                                                        <input type="text" pattern="\d*" maxlength="10" name="ci_accounts_phone" value="<?php echo $getSql['ci_accounts_phone']; ?>"  class="form-control" placeholder="Phone" required>
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
                                                        <input type="email" name="ci_accounts_email" value="<?php echo $getSql['ci_accounts_email']; ?>"  class="form-control" placeholder="Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn bg-blue waves-effect" name="save" value="Go to Next Step">
                                    </form>
                                    <?php

                                    if (isset($_POST['save']))
                                    {
                                        $sqlCountData = mysqli_query($db, "UPDATE `carrierprofile` SET `scac`='".$_POST['scac']."', `fedidno`='".$_POST['fedidno']."',`phone`='".$_POST['phone']."',`fax`='".$_POST['fax']."',`email`='".$_POST['email']."',`contact`='".$_POST['phone']."', `remitstreet`='".$_POST['remitstreet']."',`remitcity`='".$_POST['remitcity']."', `remitstate`='".$_POST['remitstate']."',`remitzipcode`='".$_POST['remitzipcode']."',`ci_dispatcher`='".$_POST['ci_dispatcher']."', `ci_mainphone`='".$_POST['ci_mainphone']."', `ci_afterhour`='".$_POST['ci_afterhour']."',`ci_email`='".$_POST['ci_email']."', `ci_operationamanager`='".$_POST['ci_operationamanager']."', `ci_om_phone`='".$_POST['ci_om_phone']."', `ci_om_email`='".$_POST['ci_om_email']."', `ci_accounts_payable_contact`='".$_POST['ci_accounts_payable_contact']."',`ci_accounts_phone`='".$_POST['ci_accounts_phone']."', `ci_accounts_email`='".$_POST['ci_accounts_email']."' WHERE carrier_id = '".$_SESSION['carrier_id']."'");
                                        if ($sqlCountData) {
                                            $sqlUpStep = mysqli_query($db, "UPDATE `carrierprofile` SET `steps` = '1' WHERE carrier_id = '".$_SESSION['carrier_id']."'");
                                            if ($sqlUpStep)
                                            {
                                                echo "<script>window.open('mutualconcepts.v2.php','_self')</script>";
                                            }
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