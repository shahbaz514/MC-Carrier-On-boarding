<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
include 'inc/head.php';
include "inc/sidebar.php";
$sqlProf = mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
$rowProf = mysqli_fetch_array($sqlProf);
?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title" style="text-align:center;">
                                EDIT STATUS
                            </h3><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6" style="padding: 20px;">
                                        <select name="status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option>New</option>
                                            <option>Pending</option>
                                            <option>Paid</option>
                                            <option>InProcess</option>
                                            <option>Completed</option>
                                            <option>Canceled</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6" style="padding: 20px;">
                                        <center>
                                            <input type="submit" name="editUser" value="Edit Status" class="btn btn-warning">
                                        </center>
                                    </div>
                                </div>
                            </form>


                            <?php
                            if (isset($_POST['editUser']))
                            {
                                $status = mysqli_real_escape_string($db, $_POST['status']);
                                $sqlU = mysqli_query($db, "UPDATE cus_orders SET status = '$status' WHERE orderid = '".$_GET['orderId']."'");
                                if ($sqlU)
                                {
                                    echo "<script>window.open('invoices.php', '_self')</script>";
                                }
                            }
                            ?>

                            <style>
                                input{
                                    margin-top: 20px;
                                }
                                select{
                                    margin-top: 20px;
                                }
                            </style>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
<?php
include "inc/footer.php";
?>