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
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '".$_GET['edit']."'"));
?>
    <section>
        <?php include 'inc/sidebar.php'; ?>
    </section>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>CONTRACT FOR MOTOR CARRIER SERVICES</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>CONTRACT FOR MOTOR CARRIER SERVICES</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="cont_name_auth_carier_representative" value="<?php echo @$getSql['cont_name_auth_carier_representative']; ?>"  class="form-control" placeholder="Enter Name of Authorized Carrier Representative" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="cont_title_auth_carier_representative" value="<?php echo @$getSql['cont_title_auth_carier_representative']; ?>"  class="form-control" placeholder="Enter Title of Authorized Carrier Representative" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn bg-blue waves-effect" name="save" value="Go To Next Step">
                                    </form>
                                    <?php
                                    if (isset($_POST['save']))
                                    {
                                        $sqlCountData = mysqli_query($db, "UPDATE `carrierprofile` SET `cont_name_auth_carier_representative`='".$_POST['cont_name_auth_carier_representative']."',`cont_title_auth_carier_representative`='".$_POST['cont_title_auth_carier_representative']."' WHERE carrier_id = '".$_GET['edit']."'");
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