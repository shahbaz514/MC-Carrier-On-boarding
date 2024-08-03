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
?>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>FINALIZED YOUR DATA</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>FINALIZED YOUR DATA</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5>
                                                    Do you want to Finalize your Data?
                                                    <span class="bg-red">
                                                        If you Finalize the Data then cannot be able to Update your Info.
                                                    </span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="submit" class="btn btn-warning form-control" name="save" value="Finalized">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="submit" class="btn btn-danger form-control" name="cancel" value="Cancel">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['cancel']))
                                    {
                                        header("Location: index.php");
                                    }
                                    if (isset($_POST['save']))
                                    {
                                        $sqlCountData = mysqli_query($db, "UPDATE `carrierprofile` SET `status`='Completed' WHERE carrier_id = '".$_SESSION['carrier_id']."'");
                                        if ($sqlCountData) {
                                            echo "<script>window.open('../logout.php','_self')</script>";
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