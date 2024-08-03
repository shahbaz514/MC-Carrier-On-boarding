<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
if (isset($_GET['del']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM pro_feat WHERE id = '".$_GET['del']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('features.php?id=".$_GET['id']."', '_self')</script>";
    }
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
                            Features
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table class="display expandable-table" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Included(Yes/No)</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sqlUsers = mysqli_query($db, "SELECT * FROM pro_feat WHERE p_id = '".$_GET['id']."' ORDER BY id ASC");
                            while ($rowUser = mysqli_fetch_array($sqlUsers))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $rowUser['title'] ; ?></td>
                                    <td><?php echo $rowUser['status'] ; ?></td>
                                    <td>
                                        <a class="btn btn-info" href="features.php?id=<?php echo $_GET['id']; ?>&&del=<?php echo $rowUser['id'] ; ?>">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
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
                                    <input type="text" name="name" placeholder="Name" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <select name="feature" id="" class="form-control" required>
                                        <option value="">--Can this feature Included?--</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="addUser" value="Add Features" class="btn bg-warning">
                                </div>
                            </div>
                        </form>


                        <?php
                        if (isset($_POST['addUser']))
                        {
                            $name = mysqli_real_escape_string($db, $_POST['name']);
                            $feature = mysqli_real_escape_string($db, $_POST['feature']);
                            $sql = mysqli_query($db, "INSERT INTO `pro_feat`(`p_id`, `title`, `status`) VALUES ('".$_GET['id']."','$name','$feature')");
                            if ($sql)
                            {
                                echo "<script>window.open('features.php?id=".$_GET['id']."','_self')</script>";
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