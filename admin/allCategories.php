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
    $sqlDel = mysqli_query($db, "DELETE FROM categories WHERE id = '".$_GET['id']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('allCategories.php', '_self')</script>";
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
                                ALL CATEGORIES
                            </h3><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">ALL CATEGORIES</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="display expandable-table" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlUsers = mysqli_query($db, "SELECT * FROM categories ORDER BY id ASC");
                                            while ($rowUser = mysqli_fetch_array($sqlUsers))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowUser['name'] ; ?></td>
                                                    <td><?php echo $rowUser['date'] ; ?></td>
                                                    <td>
                                                        <a class="btn btn-info" href="allCategories.php?id=<?php echo $rowUser['id']; ?>">
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