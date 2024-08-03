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
                            ADD NEW CATEGORY
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="name" placeholder="Title" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="sub_head" class="form-control" placeholder="Sub Heading">
                                </div>
                                <div class="col-sm-6">
                                    <input type="file" name="img" title="Select Image" class="form-control" accept="image/*">
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
                                    <textarea name="description" class="form-control" rows="5" placeholder="Short Description"></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="addUser" value="Add New Category" class="btn bg-warning">
                                </div>
                            </div>
                        </form>


                        <?php
                        if (isset($_POST['addUser']))
                        {
                            $name = mysqli_real_escape_string($db, $_POST['name']);
                            $cat = mysqli_real_escape_string($db, $_POST['cat']);
                            $sub_head = mysqli_real_escape_string($db, $_POST['sub_head']);
                            $description = mysqli_real_escape_string($db, $_POST['description']);
                            $temp = explode(".", $_FILES["img"]["name"]);
                            $newfilename = $_SESSION['username'] . '.' . rand() . '.' . end($temp);
                            $sqlAddUser = mysqli_query($db, "INSERT INTO `categories_pro`(`name`, `sub_head`, `description`, `img`, `cat`) VALUES ('$name','$sub_head','$description','$newfilename','$cat')");
                            if ($sqlAddUser) {
                                $move = move_uploaded_file($_FILES["img"]["tmp_name"], "../images/" . $newfilename);
                                if ($move)
                                {
                                    echo "<script>window.open('allCategoriesProducts.php', '_self')</script>";
                                }
                            } else {
                                echo "<script>alert('Take An Error! Try Again.')</script>";
                                echo "<script>window.open('allCategoriesProducts.php', '_self')</script>";
                            }
                        }
                        ?>

                        <style>
                            input{
                                margin-top: 20px;
                            }
                            select,textarea{
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