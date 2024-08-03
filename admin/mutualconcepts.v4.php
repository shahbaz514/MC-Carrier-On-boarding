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
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `equipment_info` WHERE carrier_id = '".$_GET['edit']."'"));
?>
    <section>
        <?php include 'inc/sidebar.php'; ?>
    </section>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>EQUIPMENT</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>EQUIPMENT</h2>
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
                                                            Tractors:
                                                        </label>
                                                        <input type="text" pattern="\d*" name="eq_tractor" value="<?php echo @$getSql['eq_tractor']; ?>"  class="form-control" placeholder="No. of Tractors" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Dry Van:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_dry_van"  required>
                                                            <option value="">-- Dry Van --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Flatbed:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_flatbed"  required>
                                                            <option value="">-- Flatbed --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Reefer:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_reefer"  required>
                                                            <option value="">-- Reefer --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            HotShot:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_hotshot"  required>
                                                            <option value="">-- HotShot --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            CDL:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_cdl"  required>
                                                            <option value="">-- CDL --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            TWIC:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_twic"  required>
                                                            <option value="">-- TWIC --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Hazmat:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_hazmat"  required>
                                                            <option value="">-- Hazmat --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <h5>Traffic Lanes that your company services:</h5>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            North East:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_north_east"  required>
                                                            <option value="">-- North East --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            South West:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_south_west"  required>
                                                            <option value="">-- South West --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            South East:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_south_east"  required>
                                                            <option value="">-- South East --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            North West:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_north_west"  required>
                                                            <option value="">-- North West --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Mid West:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_mid_west"  required>
                                                            <option value="">-- Mid West --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Central:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_central"  required>
                                                            <option value="">-- Central --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Select Preferred State or Lane:
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_prefered_states" data-live-search="true" multiple required>
                                                            <option value="">-- Select Preferred State or Lane --</option>
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
                                                            Email available loads?
                                                        </label>
                                                        <select class="form-control show-tick" name="eq_email_available_load"  required>
                                                            <option value="">-- Email available loads? --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">
                                                            Email Address to send available loads:
                                                        </label>
                                                        <input type="email" class="form-control show-tick" placeholder="Email Address to send available loads" name="eq_email_load" value="<?php echo @$getSql['eq_email_load']; ?>" required />
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">Do you have a locking policy in place? </label>
                                                        <select class="form-control show-tick" name="eq_looking_policy"  required>
                                                            <option value="">-- Do you have a locking policy in place? --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">Are all drivers required to keep trailer doors-locked until reaching their final destination? </label>
                                                        <select class="form-control show-tick" name="eq_trailer_lock_doors"  required>
                                                            <option value="">-- Are all drivers required to keep trailer doors-locked until reaching their final destination?  --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">Do you perform criminal background checks on drivers?</label>
                                                        <select class="form-control show-tick" name="eq_driver_criminal_record_check"  required>
                                                            <option value="">-- Do you perform criminal background checks on drivers? --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">Does your company do business in the state of CA?</label>
                                                        <select class="form-control show-tick" name="eq_do_business_in_ca"  required>
                                                            <option value="">-- Does your company do business in the state of CA? --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="">Are all of your TRU’s registered on ARBER and in compliance with CA ARB & ATCM in-use engine emission standards?</label>
                                                        <select class="form-control show-tick" name="eq_tru_restered_on_arber"  required>
                                                            <option value="">-- Are all of your TRU’s registered on ARBER? --</option>
                                                            <option>Yes</option>
                                                            <option>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5>Please list your CA-ARB Identification Number below or attach a list of all of your
                                                    ARB & ATCM approved units.</h5>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" pattern="\d*" maxlength="4" class="form-control" placeholder="Year" name="eq_year" value="<?php echo @$getSql['eq_year']; ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Make" name="eq_make" value="<?php echo @$getSql['eq_make']; ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Color" name="eq_color" value="<?php echo @$getSql['eq_color']; ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text"  class="form-control" placeholder="Plate#" name="eq_plate" value="<?php echo @$getSql['eq_plate']; ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" pattern="\d*" maxlength="6" class="form-control" placeholder="Last 6 Vin#" name="eq_last_vin" value="<?php echo @$getSql['eq_last_vin']; ?>" required />
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
                                        $getDataRows = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `equipment_info` WHERE carrier_id = '".$_GET['edit']."'"));
                                        if ($getDataRows>0)
                                        {
                                            $sqlCountData = mysqli_query($db, "UPDATE `equipment_info` SET `eq_tractor`='".$_POST['eq_tractor']."',`eq_dry_van`='".$_POST['eq_dry_van']."',`eq_flatbed`='".$_POST['eq_flatbed']."',`eq_reefer`='".$_POST['eq_reefer']."',`eq_hotshot`='".$_POST['eq_hotshot']."',`eq_cdl`='".$_POST['eq_cdl']."',`eq_twic`='".$_POST['eq_twic']."',`eq_hazmat`='".$_POST['eq_hazmat']."',`eq_north_east`='".$_POST['eq_north_east']."',`eq_south_west`='".$_POST['eq_south_west']."',`eq_south_east`='".$_POST['eq_south_east']."',`eq_north_west`='".$_POST['eq_north_west']."',`eq_mid_west`='".$_POST['eq_mid_west']."',`eq_central`='".$_POST['eq_central']."',`eq_prefered_states`='".$_POST['eq_prefered_states']."',`eq_email_available_load`='".$_POST['eq_email_available_load']."',`eq_email_load`='".$_POST['eq_email_load']."',`eq_looking_policy`='".$_POST['eq_looking_policy']."',`eq_trailer_lock_doors`='".$_POST['eq_trailer_lock_doors']."',`eq_driver_criminal_record_check`='".$_POST['eq_driver_criminal_record_check']."',`eq_do_business_in_ca`='".$_POST['eq_do_business_in_ca']."',`eq_tru_restered_on_arber`='".$_POST['eq_tru_restered_on_arber']."',`eq_year`='".$_POST['eq_year']."',`eq_make`='".$_POST['eq_make']."',`eq_color`='".$_POST['eq_color']."',`eq_plate`='".$_POST['eq_plate']."',`eq_last_vin`='".$_POST['eq_last_vin']."' WHERE carrier_id = '".$_GET['edit']."'");
                                        }
                                        else
                                        {
                                            $sqlCountData = mysqli_query($db, "INSERT INTO `equipment_info`(`carrier_id`, `eq_tractor`, `eq_dry_van`, `eq_flatbed`, `eq_reefer`, `eq_hotshot`, `eq_cdl`, `eq_twic`, `eq_hazmat`, `eq_north_east`, `eq_south_west`, `eq_south_east`, `eq_north_west`, `eq_mid_west`, `eq_central`, `eq_prefered_states`, `eq_email_available_load`, `eq_email_load`, `eq_looking_policy`, `eq_trailer_lock_doors`, `eq_driver_criminal_record_check`, `eq_do_business_in_ca`, `eq_tru_restered_on_arber`, `eq_year`, `eq_make`, `eq_color`, `eq_plate`, `eq_last_vin`) VALUES ('".$_GET['edit']."', '".$_POST['eq_tractor']."', '".$_POST['eq_dry_van']."', '".$_POST['eq_flatbed']."', '".$_POST['eq_reefer']."', '".$_POST['eq_hotshot']."', '".$_POST['eq_cdl']."', '".$_POST['eq_twic']."', '".$_POST['eq_hazmat']."', '".$_POST['eq_north_east']."', '".$_POST['eq_south_west']."', '".$_POST['eq_south_east']."', '".$_POST['eq_north_west']."', '".$_POST['eq_mid_west']."', '".$_POST['eq_central']."', '".$_POST['eq_prefered_states']."', '".$_POST['eq_email_available_load']."', '".$_POST['eq_email_load']."', '".$_POST['eq_looking_policy']."', '".$_POST['eq_trailer_lock_doors']."', '".$_POST['eq_driver_criminal_record_check']."', '".$_POST['eq_do_business_in_ca']."', '".$_POST['eq_tru_restered_on_arber']."', '".$_POST['eq_year']."', '".$_POST['eq_make']."', '".$_POST['eq_color']."', '".$_POST['eq_plate']."', '".$_POST['eq_last_vin']."')");
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