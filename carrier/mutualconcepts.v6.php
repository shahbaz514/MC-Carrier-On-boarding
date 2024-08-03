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
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `w9_form` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
$getSqlS = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
$steps = $getSqlS['steps'];
$steps++;
if (!isset($_GET['edit'])) {
    if ($steps != '6') {
        header("Location: mutualconcepts.v" . $steps . ".php");
    }
}
?>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>W-9 Form</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>W-9 Form</h2>
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
                                                            Name (as shown on your income tax return). Name is required on this line; do not leave this line blank. 
                                                            <span style="color: red;">*</span> 
                                                        </label>
                                                        <input type="text" name="name" value="<?php echo @$getSql['name']; ?>"  class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Business name/disregarded entity name, if different from above
                                                        </label>
                                                        <input type="text" name="business_name" value="<?php echo @$getSql['business_name']; ?>"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Check appropriate box for federal tax classification of the person whose name is entered on line 1. Check only one of the following seven boxes. 
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <select class="form-control show-tick" name="fed_tex_classification"  required>
                                                            <option value="">Select Classification</option>
                                                            <option value="1">Individual/sole proprietor or single-member LLC</option>
                                                            <option value="2">C Corporation</option>
                                                            <option value="3">S Corporation</option>
                                                            <option value="4">Partnership</option>
                                                            <option value="5">Trust/estate</option>
                                                            <option value="6">Limited liability company</option>
                                                            <option value="7">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            If Select "Limited liability company". Select the tax classification (C=C corporation, S=S corporation, P=Partnership)
                                                        </label>
                                                        <select class="form-control show-tick" name="limited_ability">
                                                            <option value="">Select Limited Liability Company Tax classification</option>
                                                            <option value="C">C=C corporation</option>
                                                            <option value="S">S=S corporation</option>
                                                            <option value="P">P=Partnership</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Exempt payee code (if any)
                                                        </label>
                                                        <input type="number" pattern="\d*" name="examption_code" value="<?php echo @$getSql['examption_code']; ?>"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>Exemption from FATCA reporting code (if any)</label>
                                                        <input type="number" pattern="\d*" name="examption_from_fatca" value="<?php echo @$getSql['examption_from_fatca']; ?>"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Address (number, street, and apt. or suite no.)
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" name="address" value="<?php echo @$getSql['address']; ?>"  class="form-control" placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Select City:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <select class="form-control show-tick" name="city" data-live-search="true">
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
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <select class="form-control show-tick" name="state" data-live-search="true">
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
                                                            ZIP code:
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" pattern="\d*" maxlength="5" name="zipcode" class="form-control" placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            List account number(s) here (optional)
                                                        </label>
                                                        <input type="text" pattern="\d*" name="account_number" value="<?php echo @$getSql['account_number']; ?>"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>Requester’s name and address (optional)</label>
                                                        <input type="text" name="requester_name_address" value="<?php echo @$getSql['requester_name_address']; ?>"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Select Taxpayer Identification Number (TIN)
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <select class="form-control show-tick" name="tin"  required>
                                                            <option value="">Select Taxpayer Identification Number (TIN)</option>
                                                            <option value="1">Social security number</option>
                                                            <option value="2">Employer identification number</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            TIN#
                                                            <span style="color: red;">*</span>
                                                        </label>
                                                        <input type="text" pattern="\d*" minlength="9" name="tin_no" value="<?php echo @$getSql['tin_no']; ?>"  class="form-control" placeholder="Enter TIN#" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn bg-blue waves-effect" name="save" value="Go To Next Step">
                                        <a href="mutualconcepts.v5.php?edit" class="btn bg-orange waves-effect">
                                            Go to Previous Page
                                        </a>
                                    </form>
                                    <?php
                                    if (isset($_POST['save']))
                                    {
                                        $getDataRows = 0;
                                        $getDataRows = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `w9_form` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));

                                        $name = mysqli_real_escape_string($db, $_POST['name']);
                                        $business_name = mysqli_real_escape_string($db, $_POST['business_name']);
                                        $fed_tex_classification = mysqli_real_escape_string($db, $_POST['fed_tex_classification']);
                                        $limited_ability = mysqli_real_escape_string($db, $_POST['limited_ability']);
                                        $examption_code = mysqli_real_escape_string($db, $_POST['examption_code']);
                                        $examption_from_fatca = mysqli_real_escape_string($db, $_POST['examption_from_fatca']);
                                        $address = mysqli_real_escape_string($db, $_POST['address']);
                                        $city = mysqli_real_escape_string($db, $_POST['city']);
                                        $state = mysqli_real_escape_string($db, $_POST['state']);
                                        $zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);

                                        $city_state_zipcode = $city . ", " .$state . ", " .$zipcode;
                                        $account_number = mysqli_real_escape_string($db, $_POST['account_number']);
                                        $requester_name_address = mysqli_real_escape_string($db, $_POST['requester_name_address']);
                                        $tin = mysqli_real_escape_string($db, $_POST['tin']);
                                        $tin_no = mysqli_real_escape_string($db, $_POST['tin_no']);
                                        if ($getDataRows>0)
                                        {
                                            $sqlCountData = mysqli_query($db, "UPDATE `w9_form` SET `name`='$name',`business_name`='$business_name',`fed_tex_classification`='$fed_tex_classification',`limited_ability`='$limited_ability',`examption_code`='$examption_code',`examption_from_fatca`='$examption_from_fatca',`address`='$address',`city_state_zipcode`='$city_state_zipcode',`account_number`='$account_number',`requester_name_address`='$requester_name_address',`tin`='$tin',`tin_no`='$tin_no' WHERE carrier_id = '".$_SESSION['carrier_id']."'");
                                        }
                                        else
                                        {
                                            $sqlCountData = mysqli_query($db, "INSERT INTO `w9_form`(`carrier_id`, `name`, `business_name`, `fed_tex_classification`, `limited_ability`, `examption_code`, `examption_from_fatca`, `address`, `city_state_zipcode`, `account_number`, `requester_name_address`, `tin`, `tin_no`) VALUES ('".$_SESSION['carrier_id']."', '$name','$business_name','$fed_tex_classification','$limited_ability','$examption_code','$examption_from_fatca','$address','$city_state_zipcode','$account_number','$requester_name_address','$tin','$tin_no')");
                                        }


                                        if ($sqlCountData) {
                                            $sqlUpStep = mysqli_query($db, "UPDATE `carrierprofile` SET `steps` = '6' WHERE carrier_id = '".$_SESSION['carrier_id']."'");
                                            if ($sqlUpStep)
                                            {
                                                if ($_SESSION['status'] == 'InReview')
                                                {
                                                    echo "<script>window.open('viewSubmitedData.php','_self')</script>";
                                                }
                                                else
                                                {
                                                    echo "<script>window.open('mutualconcepts.v7.php','_self')</script>";
                                                }
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