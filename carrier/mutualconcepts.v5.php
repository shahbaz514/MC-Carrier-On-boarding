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
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
$steps = $getSql['steps'];
$steps++;
if (!isset($_GET['edit'])) {
    if ($steps != '5') {
        header("Location: mutualconcepts.v" . $steps . ".php");
    }
}
?>
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
                                        <a href="mutualconcepts.v4.php?edit" class="btn bg-orange waves-effect">
                                            Go to Previous Page
                                        </a>
                                    </form>
                                    <?php
                                    if (isset($_POST['save']))
                                    {
                                        $sqlCountData = mysqli_query($db, "UPDATE `carrierprofile` SET `cont_name_auth_carier_representative`='".$_POST['cont_name_auth_carier_representative']."',`cont_title_auth_carier_representative`='".$_POST['cont_title_auth_carier_representative']."' WHERE carrier_id = '".$_SESSION['carrier_id']."'");
                                        if ($sqlCountData) {
                                            $sqlUpStep = mysqli_query($db, "UPDATE `carrierprofile` SET `steps` = '5' WHERE carrier_id = '".$_SESSION['carrier_id']."'");
                                            if ($sqlUpStep)
                                            {
                                                echo "<script>window.open('mutualconcepts.v6.php','_self')</script>";
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