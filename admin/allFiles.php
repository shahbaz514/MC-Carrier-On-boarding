<?php
session_start();
session_abort();
include "db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
if ($_SESSION['role'] == 'Data Uploader')
{
    header("Location: dataUploader.php");
}

if (isset($_GET['id']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM data_uploader WHERE id = '".$_GET['id']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('allFiles.php', '_self')</script>";
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
                                UPLOADED FILE APPROVALS
                            </h3><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">
                                UPLOADED FILE APPROVALS
                            </p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="display expandable-table" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>File Code</th>
                                                <th>File Type</th>
                                                <th>File Name</th>
                                                <th>Category</th>
                                                <th>Username</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                    <?php
                                    $i = 0;
                                    $sqlUsers = mysqli_query($db, "SELECT * FROM data_uploader ORDER BY id DESC");
                                    while ($rowUser = mysqli_fetch_array($sqlUsers))
                                    {
                                        $parent_id = "";
                                        $list = $rowUser['cat_id'];
                                        $previous_cat = "";
                                        $sub_sub_cat = "";
                                        $tag_array = explode(',', $list );
                                        foreach ($tag_array as $x)
                                        {
                                            $parent_id = $x;
                                            break;
                                        }
                                        $i++;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>.
                                            </td>
                                            <td>
                                                <?php echo $rowUser['id']; ?>.
                                            </td>
                                            <td><?php echo $rowUser['file_type'] ; ?></td>
                                            <td>
                                                <?php

                                                if ($rowUser['name'] == null) {
                                                    echo $rowUser['file_name'];
                                                } else {
                                                    echo $rowUser['name'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($parent_id != null) {
                                                    $main = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM categories WHERE id = '$parent_id'"));
                                                    echo $main['name'];
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $rowUser['username'] ; ?></td>
                                            <td><?php echo $rowUser['date'] ; ?></td>
                                            <td><?php echo $rowUser['status'] ; ?></td>
                                            <td>
                                                <a class="btn btn-danger" href="fileView.php?id=<?php echo $rowUser['id']; ?>">
                                                    <i class="mdi mdi-eye"></i>
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
                    </div>


                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
<?php
include "inc/footer.php";
?>