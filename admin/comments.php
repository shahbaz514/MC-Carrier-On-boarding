<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
if (isset($_GET['id']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM comments WHERE id = '".$_GET['id']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('comments.php', '_self')</script>";
    }
}
if (isset($_GET['status']))
{
    $id = $_GET['status'];
    $sqlgetstatus = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM comments WHERE id = '$id'"));
    $statusget = $sqlgetstatus['status'];
    if ($statusget == null)
    {
        $update = mysqli_query($db, "UPDATE comments SET status = 'Approve' WHERE id = '$id'");
        if ($update)
        {
            echo "<script>window.open('comments.php','_self')</script>";
        }
    }
    else
    {
        $update = mysqli_query($db, "UPDATE comments SET status = '' WHERE id = '$id'");
        if ($update)
        {
            echo "<script>window.open('comments.php','_self')</script>";
        }
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
                            ALL Comments
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">ALL Comments</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Comment</th>
                                            <th>Comment Type</th>
                                            <th>Post ID</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sqlUsers = mysqli_query($db, "SELECT * FROM comments ORDER BY id DESC");
                                        while ($rowUser = mysqli_fetch_array($sqlUsers))
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $rowUser['name'] ; ?></td>
                                                <td><?php echo $rowUser['email'] ; ?></td>
                                                <td>
                                                    <p style="text-align: justify">
                                                        <?php echo $rowUser['comment'] ; ?>
                                                    </p>
                                                </td>
                                                <td><?php echo $rowUser['type'] ; ?></td>
                                                <td>
                                                    <?php
                                                    if ($rowUser['type'] == 'Portfolio') {
                                                        echo '<a class="btn btn-info" href="../portfolio-single.php?id='.$rowUser['p_id'].'"><i class="ti-eye menu-icon"></i></a>';
                                                    }
                                                    else {
                                                        echo '<a class="btn btn-info" href="../blog-single.php?id='.$rowUser['p_id'].'"><i class="ti-eye menu-icon"></i></a>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $rowUser['date'] ; ?></td>
                                                <td>
                                                    <?php
                                                    if ($rowUser['status'] == null) {
                                                        echo '<a class="btn btn-warning" href="comments.php?status='.$rowUser['id'].'"><i class="ti-thumb-down menu-icon"></i></a>';
                                                    }
                                                    else {
                                                        echo '<a class="btn btn-warning" href="comments.php?status='.$rowUser['id'].'"><i class="ti-thumb-up menu-icon"></i></a>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger" href="comments.php?id=<?php echo $rowUser['id']; ?>">
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
                </div>


            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include "inc/footer.php";
?>