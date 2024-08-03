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
?>
    <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align:center;">
                            ADD NEW Testimony
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="addTestimony.php" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="designation" class="form-control" placeholder="Designation">
                                </div>
                                <div class="col-sm-6">
                                    <input type="file" name="img" title="Select Profile Image" class="form-control" accept="image/*">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="link" class="form-control" placeholder="Link">
                                </div>
                                <div class="col-sm-6">
                                    <textarea name="comment" class="form-control" rows="5" placeholder="Comment" id="kt-ckeditor-1"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="save" value="Add New Testimony" class="btn bg-warning" style="height: 60px; margin-top: 20px;">
                                </div>
                            </div>
                        </form>


                        <?php
                        if (isset($_POST['save']))
                        {
                            $name = mysqli_real_escape_string($db, $_POST['name']);
                            $designation = mysqli_real_escape_string($db, $_POST['designation']);
                            $comment = mysqli_real_escape_string($db, $_POST['comment']);
                            $link = mysqli_real_escape_string($db, $_POST['link']);
                            $temp = explode(".", $_FILES["img"]["name"]);
                            $newfilename = $_SESSION['username'] . '.' . rand() . '.' . end($temp);
                            $update = mysqli_query($db, "INSERT INTO `test`(`name`, `designation`, `img`, `comment`, `link`) VALUES ('$name', '$designation', '$newfilename', '$comment', '$link')");
                            if ($update)
                            {
                                $move = move_uploaded_file($_FILES["img"]["tmp_name"], "../images/" . $newfilename);
                                if ($move)
                                {
                                    echo "<script>window.open('testimonials.php', '_self')</script>";
                                }

                            }
                        }
                        ?>

                        <style>
                            input, textarea{
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