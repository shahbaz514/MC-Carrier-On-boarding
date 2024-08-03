<?php
ob_start();
session_start();
include "../db/db.php";
include "inc/head.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
?>
<section class="content">
    <?php
    include "inc/sidebar.php";
    ?>
</section>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DELETE PROFILE</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>DELETE PROFILE</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5>
                                                    Do you want to Delete the Profile?
                                                    <span class="bg-red">
                                                        If you Delete the Profile then cannot be able to Retrieve this Profile.
                                                    </span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="submit" class="btn btn-warning form-control" name="save" value="DELETE">
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
                                        if ($_SESSION['role'] == 'Admin' OR $_SESSION['role'] == 'Manager')
                                        {
                                            $sqlStatus = mysqli_query($db, "DELETE FROM carrierprofile WHERE carrier_id = '".$_GET['delete']."'");
                                            if ($sqlStatus)
                                            {
                                                header("Location: allCarrier.php");
                                            }
                                        }
                                        else
                                        {
                                            echo "<script>alert('You are not Authorized Person! Please Contact to Admin.')</script>";
                                            echo "<script>window.open('allCarrier.php', '_self')</script>";
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