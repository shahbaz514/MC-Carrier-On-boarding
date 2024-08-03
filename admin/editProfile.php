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
                                EDIT PROFILE
                            </h3><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="editProfile.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6" style="padding: 20px;">
                                        <input type="password" name="password" placeholder="Password" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6" style="padding: 20px;">
                                        <input type="file" name="img" title="Select Profile Image" class="form-control" accept="image/*">
                                    </div>
                                    <div class="col-sm-6" style="padding: 20px;">
                                        <center>
                                            <input type="submit" name="editUser" value="Edit Profile" class="btn btn-warning">
                                        </center>
                                    </div>
                                </div>
                            </form>


                            <?php
                            if (isset($_POST['editUser']))
                            {
                                $password = mysqli_real_escape_string($db, $_POST['password']);
                                $temp = explode(".", $_FILES["img"]["name"]);
                                $newfilename = $_SESSION['username'] . '.' . rand() . '.' . end($temp);

                                if (empty($_FILES["img"]["name"]))
                                {
                                    $sqlU = mysqli_query($db, "UPDATE users SET password = '$password' WHERE username = '".$_SESSION['username']."'");
                                    if ($sqlU)
                                    {
                                        echo "<script>window.open('profile.php', '_self')</script>";
                                    }
                                }
                                else
                                {
                                    $sqlU = mysqli_query($db, "UPDATE users SET password = '$password', img = '$newfilename' WHERE username = '".$_SESSION['username']."'");
                                    if ($sqlU)
                                    {

                                        $move = move_uploaded_file($_FILES["img"]["tmp_name"], "../images/" . $newfilename);
                                        if ($move)
                                        {
                                            echo "<script>window.open('profile.php', '_self')</script>";
                                        }

                                    }
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