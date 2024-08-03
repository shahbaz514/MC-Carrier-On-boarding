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

if (isset($_GET['id']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM users WHERE id = '".$_GET['id']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('allUsers.php', '_self')</script>";
    }
}
?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title" style="text-align:center;">
                                ALL USERS
                            </h3><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">ALL USERS</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="display expandable-table" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Image</th>
                                                <th>Role</th>
                                                <th>Date</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlUsers = mysqli_query($db, "SELECT * FROM users ORDER BY id ASC");
                                            while ($rowUser = mysqli_fetch_array($sqlUsers))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowUser['name'] ; ?></td>
                                                    <td><?php echo $rowUser['username'] ; ?></td>
                                                    <td><?php echo $rowUser['email'] ; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($rowUser['img'] != "")
                                                        {
                                                            ?>
                                                            <img class="img-rounded" style="width: 100px; height: 100px; border-radius: 10px;" src="../images/<?php echo $rowUser['img'] ; ?>" alt="<?php echo $rowUser['name'] ; ?>">
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $rowUser['role'] ; ?></td>
                                                    <td><?php echo $rowUser['date'] ; ?></td>
                                                    <td>
                                                        <a class="btn btn-info" href="allUsers.php?id=<?php echo $rowUser['id']; ?>">
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