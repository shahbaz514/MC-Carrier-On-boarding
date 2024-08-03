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
                            ADD NEW BLOG
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="addblog.php" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" placeholder="Title / Question">
                                </div>
                                <div class="col-sm-6">
                                    <input type="file" name="img" title="Select Blog Image" class="form-control" accept="image/*">
                                </div>
                                <div class="col-sm-6">
                                    <select name="cat" id="" class="form-control">
                                        <option value="">Select Category</option>
                                        <?php
                                            $sqlUsers = mysqli_query($db, "SELECT * FROM categories ORDER BY id ASC");
                                            while ($rowUser = mysqli_fetch_array($sqlUsers))
                                            {
                                                echo '<option value="'.$rowUser['id'].'">'.$rowUser['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <textarea name="description" class="form-control" rows="5" placeholder="Description / Answer" id="kt-ckeditor-1"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="save" value="Add New Blog" class="btn bg-warning" style="height: 60px; margin-top: 20px;">
                                </div>
                            </div>
                        </form>


                        <?php
                        if (isset($_POST['save']))
                        {
                            $name = mysqli_real_escape_string($db, $_POST['name']);
                            $description = mysqli_real_escape_string($db, $_POST['description']);
                            $cat = mysqli_real_escape_string($db, $_POST['cat']);
                            $temp = explode(".", $_FILES["img"]["name"]);
                            $newfilename = $_SESSION['username'] . '.' . rand() . '.' . end($temp);
                            $update = mysqli_query($db, "INSERT INTO `blog`(`title`, `description`, `img`, `cat`, `username`) VALUES ('$name','$description','$newfilename','$cat','".$_SESSION['username']."')");
                            if ($update)
                            {
                                $move = move_uploaded_file($_FILES["img"]["tmp_name"], "../images/" . $newfilename);
                                if ($move)
                                {
                                    echo "<script>window.open('blogs.php', '_self')</script>";
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