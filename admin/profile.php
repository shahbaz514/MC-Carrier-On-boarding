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
                                <?php echo $rowProf['name']; ?>
                            </h3><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <center>

                                <?php
                                if ($rowProf['img'] == "")
                                {
                                    ?>
                                    <img src="../images/user-lg.jpg" class="img-circle elevation-2" alt="<?php echo $rowProf['name']; ?>">
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <img style="width: 200px; border-radius: 100%; border: 5px solid lightblue;" src="../images/<?php echo $rowProf['img']; ?>" class="img-circle elevation-2" alt="<?php echo $rowProf['name']; ?>">
                                    <?php
                                }
                                ?>
                            </center>
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>
                                            Username
                                        </th>
                                        <td>
                                            <?php echo $rowProf['username']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Email
                                        </th>
                                        <td>
                                            <?php echo $rowProf['email']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Role
                                        </th>
                                        <td>
                                            <?php echo $rowProf['role']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Profile Creation Date
                                        </th>
                                        <td>
                                            <?php echo $rowProf['date']; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <center>
                                <a style="margin: 10px;" href="editProfile.php" class="btn bg-info">
                                    <i class="mdi mdi-tooltip-edit"></i>
                                </a>
                            </center>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
<?php
include "inc/footer.php";
?>